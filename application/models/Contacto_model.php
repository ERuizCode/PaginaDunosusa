<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_tipos() {
        $conn  = $this->db->conn_id;
        $res   = mysqli_query($conn, 'CALL Obtener_contacto_tipos()');
        $datos = [];
        while ($row = mysqli_fetch_object($res)) {
            $datos[] = $row;
        }
        mysqli_free_result($res);
        while (mysqli_more_results($conn)) {
            mysqli_next_result($conn);
        }
        return $datos;
    }

    public function guardar($datos) {
        $conn = $this->db->conn_id;
        $stmt = mysqli_prepare($conn, 'CALL Guardar_contacto(?, ?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'isssss',
            $datos['id_tipo'],
            $datos['nombre'],
            $datos['email'],
            $datos['telefono'],
            $datos['asunto'],
            $datos['comentarios']
        );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        while (mysqli_more_results($conn)) {
            mysqli_next_result($conn);
        }
    }
}