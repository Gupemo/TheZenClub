<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/fees.php';


class ControllerFee {

    // inicio de sesion (por si de flais)
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // listar cuotas
    public function listaCuotas(){
        return fees::listaCuotas();
    }

    //obtener cuota por id
    public function obtenerCuota($id){
        return fees::obtenerCuota($id);
    }

    //para borrar la cuota, pasandole la id
    public function borrarCuota($fee_id){
        return fees::borrarCuota($fee_id);
    }

    // editar cuota por id
    public function editarCuota($fee_id){
        return fees::editarCuota($fee_id);
    }

    //crear cuota
    public function crearCuota($datosCuota){
        return fees::crearCuota($datosCuota);
    }
}