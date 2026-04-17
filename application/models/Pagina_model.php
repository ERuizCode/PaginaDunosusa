<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    private function _call($procedure, $multiple = false) {
        $query     = $this->db->query("CALL $procedure");
        $resultado = $multiple ? $query->result() : $query->row();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

    private function _call_param($procedure, $param, $multiple = false) {
        $query     = $this->db->query("CALL $procedure(?)", [$param]);
        $resultado = $multiple ? $query->result() : $query->row();
        $this->db->conn_id->next_result();
        $query->free_result();
        return $resultado;
    }

    public function Obtener_slogan()             { return $this->_call('Obtener_slogan()'); }
    public function Obtener_servicios()          { return $this->_call('Obtener_servicios()', true); }
    public function Obtener_header_nav()         { return $this->_call('Obtener_header_nav()', true); }
    public function Obtener_footer_contacto()    { return $this->_call('Obtener_footer_contacto()', true); }
    public function Obtener_footer_ubicaciones() { return $this->_call('Obtener_footer_ubicaciones()', true); }
    public function Obtener_footer_redes()       { return $this->_call('Obtener_footer_redes()', true); }

    public function Obtener_seccion($tipo) {
        return $this->_call_param('Obtener_seccion', $tipo);
    }
}
