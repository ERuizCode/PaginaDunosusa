<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    private function _call($pa) {
        $q = $this->db->query("CALL {$pa}()");
        $result = $q->result();
        $this->db->conn_id->next_result();
        $q->free_result();
        return $result;
    }

    private function _call_row($pa) {
        $q = $this->db->query("CALL {$pa}()");
        $result = $q->row();
        $this->db->conn_id->next_result();
        $q->free_result();
        return $result;
    }

    public function get_slogan() {
        return $this->_call_row('Obtener_slogan');
    }

    public function get_puritano() {
        return $this->_call_row('Obtener_puritano');
    }

    public function get_servicios() {
        return $this->_call('Obtener_servicios');
    }

    public function get_somos() {
        return $this->_call_row('Obtener_somos');
    }

    public function get_terreno() {
        return $this->_call_row('Obtener_terreno');
    }

    public function get_header_nav() {
        return $this->_call('Obtener_header_nav');
    }

    public function get_footer_contacto() {
        return $this->_call_row('Obtener_footer_contacto');
    }

    public function get_footer_ubicaciones() {
        return $this->_call('Obtener_footer_ubicaciones');
    }
}