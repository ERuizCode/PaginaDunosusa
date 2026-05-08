<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function registrar($datos) {
        $conn = $this->db->conn_id;
        $hash = password_hash($datos['password'], PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn,
            'CALL Registrar_usuario(?, ?, ?, ?, ?)'
        );
        mysqli_stmt_bind_param($stmt, 'sssss',
            $datos['nombre'],
            $datos['ap_paterno'],
            $datos['ap_materno'],
            $datos['correo'],
            $hash
        );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        while (mysqli_more_results($conn)) {
            mysqli_next_result($conn);
        }
    }

    public function buscar_por_correo($correo) {
        $conn = $this->db->conn_id;
        $res  = mysqli_query($conn, "CALL Buscar_usuario_por_correo('".mysqli_real_escape_string($conn, $correo)."')");
        $row  = mysqli_fetch_object($res);
        mysqli_free_result($res);
        while (mysqli_more_results($conn)) {
            mysqli_next_result($conn);
        }
        return $row;
    }
}