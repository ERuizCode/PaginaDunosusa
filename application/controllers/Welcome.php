<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pagina_model');
        $this->load->model('Productos_model');
        
    }

    private function _datos_layout() {
    return [
        'nav_links'          => $this->Pagina_model->Obtener_header_nav(),
        'footer_contacto'    => $this->Pagina_model->Obtener_footer_contacto(),
        'footer_ubicaciones' => $this->Pagina_model->Obtener_footer_ubicaciones(),
        'footer_redes'       => $this->Pagina_model->Obtener_footer_redes(),
    ];
}

    public function index()  { redirect('welcome/home'); }

    public function home() {
        $data = $this->_datos_layout();
        $data['slogan']       = $this->Pagina_model->Obtener_slogan();
        $data['nuservicio']   = $this->Pagina_model->Obtener_seccion('nuservicio');
        $data['puritano']     = $this->Pagina_model->Obtener_seccion('puritano');
        $data['somos']        = $this->Pagina_model->Obtener_seccion('somos');
        $data['terreno']      = $this->Pagina_model->Obtener_seccion('terreno');
        $data['servicios']    = $this->Pagina_model->Obtener_servicios();
        $this->load->view('dunosusa/home', $data);
    }

    public function nosotros() {
        $data = $this->_datos_layout();
        $this->load->view('dunosusa/nosotros', $data);
    }

    public function externos() {
    $this->load->model('Externos_model');
    $data = $this->_datos_layout();
    $data['externos'] = $this->Externos_model->get_externos();
    $this->load->view('dunosusa/externos', $data);
    }

    public function sucursales(){
    $this->load->model('Sucursales_model');
    $data = $this->_datos_layout();  // ← esto faltaba
    $data['sucursales'] = $this->Sucursales_model->get_sucursales();
    $this->load->view('dunosusa/sucursales', $data);
    }

    public function contacto() {
    $this->load->model('Contacto_model');
    $data = $this->_datos_layout();

    $data['tipos']   = $this->Contacto_model->get_tipos();
    $data['enviado'] = false;
    $data['error']   = '';

    if ($this->input->post('submit_contacto')) {
        $id_tipo     = (int) $this->input->post('id_tipo');
        $nombre      = trim($this->input->post('nombre'));
        $email       = trim($this->input->post('email'));
        $telefono    = trim($this->input->post('telefono'));
        $asunto      = trim($this->input->post('asunto'));
        $comentarios = trim($this->input->post('comentarios'));

        if (!$id_tipo || !$nombre || !$email || !$asunto || !$comentarios) {
            $data['error'] = 'Por favor completa todos los campos obligatorios.';
        } else {
            $this->Contacto_model->guardar([
                'id_tipo'     => $id_tipo,
                'nombre'      => $nombre,
                'email'       => $email,
                'telefono'    => $telefono,
                'asunto'      => $asunto,
                'comentarios' => $comentarios
            ]);
            $data['enviado'] = true;
        }
    }

    // Solo carga la vista de contacto — el header y footer van DENTRO de la vista
    $this->load->view('dunosusa/contacto', $data);
    }





    public function productos() {
    $data = $this->_datos_layout();
    $data['categorias']       = $this->Productos_model->get_categorias();
    $data['productos']        = [];
    $data['subcategorias']    = [];
    $data['categoria_activa'] = null;
    $data['sub_activa']       = null;
    $data['busqueda']         = $this->input->get('q');

    $id_cat = $this->input->get('cat');
    $id_sub = $this->input->get('sub');
    $buscar = $this->input->get('q');

    if ($buscar) {
        $data['productos'] = $this->Productos_model->buscar_productos($buscar);
    } elseif ($id_sub) {
        $data['productos']  = $this->Productos_model->get_productos_por_subcategoria($id_sub);
        $data['sub_activa'] = $id_sub;
    } elseif ($id_cat) {
        $data['productos']        = $this->Productos_model->get_productos_por_categoria($id_cat);
        $data['subcategorias']    = $this->Productos_model->get_subcategorias($id_cat);
        $data['categoria_activa'] = $id_cat;
    }

    $this->load->view('dunosusa/productos', $data);
    }

    public function login() {
    $this->load->model('Usuarios_model');
    $data = $this->_datos_layout();

    if ($this->input->post('submit_login')) {
        $correo   = $this->input->post('correo');
        $password = $this->input->post('password');
        $token    = $this->input->post('g-recaptcha-response');

        $captcha_ok = false;

        if (!empty($token)) {
            $post_data = http_build_query([
                'secret'   => RECAPTCHA_SECRET_KEY,
                'response' => $token,
                'remoteip' => $this->input->ip_address()
            ]);

            $options = [
                'http' => [
                    'method'  => 'POST',
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'content' => $post_data
                ]
            ];

            $context = stream_context_create($options);
            $verify  = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
            $captcha = json_decode($verify);

            if (!empty($captcha->success)) {
                $captcha_ok = true;
            }
        }

        if (!$captcha_ok) {
            $data['error_login'] = 'Por favor confirma que no eres un robot.';
        } else {
            $usuario = $this->Usuarios_model->buscar_por_correo($correo);

            if ($usuario && password_verify($password, $usuario->password)) {
                $this->session->set_userdata([
                    'usuario_id'     => $usuario->id,
                    'usuario_nombre' => $usuario->nombre,
                    'logueado'       => true
                ]);
                redirect('welcome/home');
            } else {
                $data['error_login'] = 'Correo o contraseña incorrectos.';
            }
        }
    }

    $this->load->view('dunosusa/login', $data);
    }

    public function registro() {
    $this->load->model('Usuarios_model');
    $data = $this->_datos_layout();

    if ($this->input->post('submit_registro')) {
        $correo = $this->input->post('correo');

        if ($this->Usuarios_model->buscar_por_correo($correo)) {
            $data['error_registro'] = 'Este correo ya está registrado.';
        } else {
            $this->Usuarios_model->registrar([
                'nombre'     => $this->input->post('nombre'),
                'ap_paterno' => $this->input->post('ap_paterno'),
                'ap_materno' => $this->input->post('ap_materno'),
                'correo'     => $correo,
                'password'   => $this->input->post('password')
            ]);
            redirect('welcome/login');
        }
    }

    $this->load->view('dunosusa/registro', $data);
    }

    public function bolsadetrabajo() {
    $this->load->model('BolsaTrabajo_model');
    $data = $this->_datos_layout();

    $data['categorias']       = $this->BolsaTrabajo_model->get_categorias();
    $data['empleos']          = [];
    $data['categoria_activa'] = null;
    $data['busqueda']         = $this->input->get('q');

    $id_cat = $this->input->get('cat');
    $buscar = $this->input->get('q');

    if ($buscar) {
        $data['empleos'] = $this->BolsaTrabajo_model->buscar_empleos($buscar);
    } elseif ($id_cat) {
        $data['empleos']          = $this->BolsaTrabajo_model->get_empleos_por_categoria($id_cat);
        $data['categoria_activa'] = $id_cat;
    } else {
        $data['empleos'] = $this->BolsaTrabajo_model->get_empleos();
    }

    $this->load->view('dunosusa/bolsadetrabajo', $data);
    }

    public function empleo_detalle() {
    $this->load->model('BolsaTrabajo_model');
    $data = $this->_datos_layout();

    $id = (int) $this->input->get('id');
    $data['empleo'] = $this->BolsaTrabajo_model->get_detalle($id);

    if (!$data['empleo']) {
        redirect('welcome/bolsadetrabajo');
    }

    $this->load->view('dunosusa/empleo_detalle', $data);
    }            


}