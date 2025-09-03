<?php

require_once '../core/DB.php';

class controllerLogin{
    public function __construct(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

    }

    //funcion para registrar usuario.
    public function registrarUsuario($userData, $userContactData){
        return DB::registrar;
    }
}