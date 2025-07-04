<?php

include './DB.php';

class ControllerLogin {

/**
 * Constructor
 */
    public function __construct() {
        session_start();
        
    }

    public function insertarUsuario($nombre, $email, $contrasena){

        $result = $this->buscarUsuario($email);
        if($result[0]){
            // Si el user existe devuelve KO
            header('location:registro.php?registro=ko');
            exit();
        } else {
            DB::insertar($nombre, $email, $contrasena);
            $user = DB::comprobarUsuario($email);
            $_SESSION['usuario'] = [$user[0]->id, $user[0]->nombre, $user[0]->rol];
            header('location:./admin/control_panel.php?registro=ok');

        }

        
    }

    /**
     * 
     */

    public function login($email, $contrasena) {
        $login = $this->comprobarUsuario($email, $contrasena);
        if($login[0]) {
            $_SESSION['usuario'] = $login[1];
            header('location:./admin/control_panel.php?login=ok');
            exit();
        }else{
            header('location:login.php?login=ko');
            exit();
        }
        
    }

    public function comprobarUsuario($email, $contrasena = null) {
        // si encuentra el user la variable found devuelve true.
        $found = false;
        $result = DB::comprobarUsuario($email);
        if(count($result) === 1) {
            if($email === $result[0]->email && password_verify($contrasena, $result[0]->contrasena)){
                $found = true;
            }
        }
        // los datos que devuelve
        return [$found, ['id' => $result[0]->id, 'rol' => $result[0]->rol]];
    }

    /**
     * Busca si el usuarioe existe.
     * @param type $email
     * @return type boolean
     */

    public function buscarUsuario($email) {
        $found = false;
        $result = DB::comprobarUsuario($email);
        if(count($result)===1){
            $found = true;
        }
        return [$found];
    }





}