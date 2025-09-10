<?php

require_once '../models/conexion.php';
require_once '../models/invitations.php';
require_once '../models/users.php';

class ControllerAuth {

    // inicio de sesion (por si de flais)
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login($dataLogin) {
        $user = Users::obtenerEmail($dataLogin['email']);
        
        if(!$user){
            error_log("Login error: no existe el email " . $dataLogin['email']);
            return false;
        }

        if(password_verify($dataLogin['password'], $user['user_password'])){
            session_regenerate_id(true);
            $_SESSION['user_id']   = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['rol']       = $user['rol_id'];
            return true;
        } else {
            error_log("Login error: password incorrecta para ".$dataLogin['email']);
            return false;
        }
    }

}