<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Externos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_externos() {
        $query = $this->db->query("CALL Obtener_externos()");
        return $query->result();
    }

}