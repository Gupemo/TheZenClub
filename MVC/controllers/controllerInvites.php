<?php

require_once __DIR__ . '/../models/invitations.php';

class ControllerInvites {
    
    public function __construct() {
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
        }
    }

    public function invitarUsuario($email) {
        // Comprobar si ya existe registro
        if (Invites::comprobarUsuario($email)) {
            return false;
        }

        // Comprobar si ya tiene invitación
        if (Invites::comprobarInvitacion($email)) {
            return false;
        }

        // Generar token
        $token = bin2hex(random_bytes(16));

        // Crear invitación
        return Invites::crearInvitacion($email, $token);
    }

    public function listarInvitaciones() {
        return Invites::obtenerInvitaciones();
    }

    public function comprobarToken($token){
        $invitacion = Invites::comprobarToken($token);
        if ($invitacion){
            return $invitacion;
        } else{
            return false;
        }

    }
}

?>