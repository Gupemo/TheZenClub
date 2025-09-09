<?php

require_once '../models/conexion.php';
require_once '../models/users.php';

class controllerUsers{
    public function __construct(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

    }

    //funcion para registrar usuario.
    public function registrarUsuario($usersData, $dataContact){
        return Users::registrarUsuario($usersData, $dataContact);

    }
}