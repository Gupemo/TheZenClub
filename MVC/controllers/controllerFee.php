<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/fees.php';


class ControllerFee {

    // inicio de sesion (por si de flais)
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function listaCuotas(){
        return fees::listaCuotas();
    }
}