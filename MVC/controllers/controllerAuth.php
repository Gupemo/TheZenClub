<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/invitations.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/users.php';


class ControllerAuth {

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