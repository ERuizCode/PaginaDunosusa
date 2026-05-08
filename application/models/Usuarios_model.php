<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function registrar($datos) {
        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
        return $this->db->insert('usuarios', $datos);
    }

    public function buscar_por_correo($correo) {
        return $this->db->get_where('usuarios', ['correo' => $correo, 'activo' => 1])->row();
    }
}