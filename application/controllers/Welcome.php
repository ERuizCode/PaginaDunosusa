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

    public function sucursales()
{
    $this->load->model('Sucursales_model');
    $data = $this->_datos_layout();  // ← esto faltaba
    $data['sucursales'] = $this->Sucursales_model->get_sucursales();
    $this->load->view('dunosusa/sucursales', $data);

}
    public function bolsadetrabajo() {
        $data = $this->_datos_layout();
        $this->load->view('dunosusa/bolsadetrabajo', $data);
    }

    public function contacto() {
        $data = $this->_datos_layout();
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






}