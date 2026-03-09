<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $this->load->view('dunosusa/home');
    }

    public function nosotros() {
        $this->load->view('dunosusa/nosotros');
    }



}
