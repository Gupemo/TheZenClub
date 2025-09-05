<?php

require_once __DIR__ . '/../core/DB.php';

class ControllerInvites {
    
    public function __construct() {
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
        }
    }

    public function invitarUsuario($email) {
        // Comprobar si ya existe registro
        if (DB::comprobarUsuario($email)) {
            return false;
        }

        // Comprobar si ya tiene invitación
        if (DB::comprobarInvitacion($email)) {
            return false;
        }

        // Generar token
        $token = bin2hex(random_bytes(16));

        // Crear invitación
        return DB::crearInvitacion($email, $token);
    }
}

?>