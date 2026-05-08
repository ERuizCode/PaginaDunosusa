<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BolsaTrabajo_model extends CI_Model {

    private function _query($sql, $params = []) {
        $q = $this->db->query($sql, $params);
        // Limpiar resultados pendientes para evitar "commands out of sync"
        if ($this->db->conn_id->more_results()) {
            $this->db->conn_id->next_result();
        }
        return $q;
    }

    public function get_categorias() {
        $q = $this->_query('CALL Obtener_empleo_categorias()');
        return $q ? $q->result() : [];
    }

    public function get_empleos() {
        $q = $this->_query('CALL Obtener_empleos()');
        return $q ? $q->result() : [];
    }

    public function get_empleos_por_categoria($id_cat) {
        $q = $this->_query('CALL Obtener_empleos_por_categoria(?)', [(int)$id_cat]);
        return $q ? $q->result() : [];
    }

    public function buscar_empleos($termino) {
        $q = $this->_query('CALL Buscar_empleos(?)', [$termino]);
        return $q ? $q->result() : [];
    }

    public function get_detalle($id) {
        $q = $this->_query('CALL Obtener_empleo_detalle(?)', [(int)$id]);
        return $q ? $q->row() : null;
    }
}