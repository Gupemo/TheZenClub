<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/payments.php';

class ControllerPayments{
    
    public function __construct() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function obtenerCuotasMes($mesSeleccionado, $anioActual){
        return Payments::pagosOkporMes($mesSeleccionado, $anioActual);
    }

    public function obtenerNoPagosMes($mesSeleccionado, $anioActual) {
    return Payments::cuotasPendientes($mesSeleccionado, $anioActual);
}




}
        
        
        
        


?>