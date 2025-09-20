<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/users.php';


class ControllerUsers{

    //funcion para registrar usuario.
    public function registrarUsuario($usersData, $dataContact, $token){
        return Users::registrarUsuario($usersData, $dataContact, $token);
        

    }

    public function userProfile($user_id){
        return Users::userProfile($user_id);
    }

    public function userContacts($user_id){
        return Users::userContacts($user_id);
    }


}