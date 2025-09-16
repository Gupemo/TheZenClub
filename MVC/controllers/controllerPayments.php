<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/models/payments.php';

class ControllerPayments{

    public function obtenerCuotasMes($mesSeleccionado, $anioActual){
        return Payments::pagosOkporMes($mesSeleccionado, $anioActual);
    }

    public function obtenerNoPagosMes($mesSeleccionado, $anioActual) {
    return Payments::cuotasPendientes($mesSeleccionado, $anioActual);
}
    public function registrarPago(){
        $mes = date('m');
        $anio = date('y');
        $fecha = date('Y-m-d');
        return Payments::registrarPagoMensual($userId, $feeId, $importe, $fecha, $metodo, $notas);
    }

}
        
        
        
        


?>