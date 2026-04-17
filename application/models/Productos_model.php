<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

    public function get_categorias() {
        $q = $this->db->query("CALL Obtener_categorias()");
        $result = $q->result();
        $this->db->conn_id->next_result();
        return $result;
    }

    public function get_subcategorias($id_cat) {
        $id_cat = (int) $id_cat;
        $q = $this->db->query("CALL Obtener_subcategorias_por_categoria($id_cat)");
        $result = $q->result();
        $this->db->conn_id->next_result();
        return $result;
    }

    public function get_productos_por_categoria($id_cat) {
        $id_cat = (int) $id_cat;
        $q = $this->db->query("CALL Obtener_productos_por_categoria($id_cat)");
        $result = $q->result();
        $this->db->conn_id->next_result();
        return $result;
    }

    public function get_productos_por_subcategoria($id_sub) {
        $id_sub = (int) $id_sub;
        $q = $this->db->query("CALL Obtener_productos_por_subcategoria($id_sub)");
        $result = $q->result();
        $this->db->conn_id->next_result();
        return $result;
    }

    public function buscar_productos($termino) {
        $termino = $this->db->escape_str($termino);
        $q = $this->db->query("CALL Buscar_productos('$termino')");
        $result = $q->result();
        $this->db->conn_id->next_result();
        return $result;
    }
}