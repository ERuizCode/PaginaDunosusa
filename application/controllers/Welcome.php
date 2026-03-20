<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pagina_model');
    }

    private function _datos_layout() {
        return [
            'nav_links'          => $this->Pagina_model->get_header_nav(),
            'footer_contacto'    => $this->Pagina_model->get_footer_contacto(),
            'footer_ubicaciones' => $this->Pagina_model->get_footer_ubicaciones(),
        ];
    }

    public function index() {
        $data = $this->_datos_layout();
        $data['slogan']    = $this->Pagina_model->get_slogan();
        $data['puritano']  = $this->Pagina_model->get_puritano();
        $data['servicios'] = $this->Pagina_model->get_servicios();
        $data['somos']     = $this->Pagina_model->get_somos();
        $data['terreno']   = $this->Pagina_model->get_terreno();

        $this->load->view('dunosusa/home', $data);
    }

    public function nosotros() {
        $data = $this->_datos_layout();
        $this->load->view('dunosusa/nosotros', $data);
    }
}