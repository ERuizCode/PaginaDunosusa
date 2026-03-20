<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function Obtener_slogan() {
        $query = $this->db->query("CALL Obtener_slogan()");
        $resultado = $query->row();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

    public function Obtener_puritano() {
        $query = $this->db->query("CALL Obtener_puritano()");
        $resultado = $query->row();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

    public function Obtener_servicios() {
        $query = $this->db->query("CALL Obtener_servicios()");
        $resultado = $query->result();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

    public function Obtener_somos() {
        $query = $this->db->query("CALL Obtener_somos()");
        $resultado = $query->row();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

    public function Obtener_terreno() {
        $query = $this->db->query("CALL Obtener_terreno()");
        $resultado = $query->row();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

    public function Obtener_header_nav() {
        $query = $this->db->query("CALL Obtener_header_nav()");
        $resultado = $query->result();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

    public function Obtener_footer_contacto() {
        $query = $this->db->query("CALL Obtener_footer_contacto()");
        $resultado = $query->row();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

    public function Obtener_footer_ubicaciones() {
        $query = $this->db->query("CALL Obtener_footer_ubicaciones()");
        $resultado = $query->result();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

}
