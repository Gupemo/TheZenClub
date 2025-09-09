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

    public function login($email, $password) {
        $user = Users::obtenerEmail($email);
        
        if($user && password_verify($password, $user['user_password'])){
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['rol'] = $user['rol_id'];
            return true;
        } else{
            return false;
        }
    }

    public function logout(){
        session_destroy();
        return true;
    }
}