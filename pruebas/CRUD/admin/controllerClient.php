<?php

include 'DB.php';

class ControllerClient {

    public function __construct(){
        if($_SESSION['usuario']['rol'] != 'user') {
            header('location./login.php');
            exit();
        }

    }
    public function verMisDatos(){
        $id = $_SESSION['usuario']['id'];
        return DB::buscarID($id);
    }
}