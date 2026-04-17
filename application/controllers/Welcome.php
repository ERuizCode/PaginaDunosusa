<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pagina_model');
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






}