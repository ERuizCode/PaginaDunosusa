<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_tipos() {
        $query = $this->db->query('CALL Obtener_contacto_tipos()');
        return $query->result();
    }

    public function guardar($datos) {
        $this->db->query(
            'CALL Guardar_contacto(?, ?, ?, ?, ?, ?)',
            [
                $datos['id_tipo'],
                $datos['nombre'],
                $datos['email'],
                $datos['telefono'],
                $datos['asunto'],
                $datos['comentarios']
            ]
        );
    }
}