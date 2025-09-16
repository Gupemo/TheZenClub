<?php
require_once 'conexion.php';

class Payments {

    public static function pagosOkporMes($mes, $anio) {
        try {
            $conexion = conexion::conn();
            $sentencia = "
                SELECT u.name, u.subname, f.name AS cuota, p.amount, p.payment_date
                FROM payments p
                JOIN users u ON p.user_id = u.user_id
                JOIN fees f ON p.fee_id = f.fee_id
                WHERE MONTH(p.payment_date) = :mes
                  AND YEAR(p.payment_date) = :anio
                ORDER BY u.name
            ";
            $consulta = $conexion->prepare($sentencia);
            $consulta->execute([
                'mes' => $mes,
                'anio' => $anio
            ]);
            
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            $consulta->closeCursor();
            $conexion = null;
            return $resultado;

        } catch (PDOException $e) {
            error_log("Error al usar pagosOkPorMes: " . $e->getMessage());
            return false;
        }
    }

    //cuotas pendientes
    public static function cuotasPendientes($mes, $anio) {
        try {
            $conexion = conexion::conn();
            $sentencia = "
                SELECT u.user_id, u.name, u.subname
                FROM users u
                LEFT JOIN payments p 
                    ON u.user_id = p.user_id 
                    AND MONTH(p.payment_date) = :mes 
                    AND YEAR(p.payment_date) = :anio
                WHERE p.payment_id IS NULL
                ORDER BY u.subname, u.name";
            $consulta = $conexion->prepare($sentencia);
            $consulta->execute([
                'mes'  => $mes,
                'anio' => $anio
            ]);
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $consulta->closeCursor();
            $conexion = null;
            return $resultado;
            } catch (PDOException $e) {
            error_log("Error al usar cuotasPendientes: " . $e -> getMessage());
            return false;
        }
    }
    
    // pagos mensuales

    public static function registrarPagoMensual($userId, $feeId, $importe, $fecha, $metodo, $notas) {
        try {
            $conexion = conexion::conn();
            $sentencia = "
                INSERT INTO payments 
                    (user_id, fee_id, payment_fee, payment_date, payment_method, payment_notes, confirmed) 
                VALUES 
                    (:user_id, :fee_id, :importe, :fecha, :metodo, :notas, TRUE)";
            
            $consulta = $conexion->prepare($sentencia);
            $consulta->execute([
                'user_id' => $userId,
                'fee_id'  => $feeId,
                'importe' => $importe,
                'fecha'   => $fecha,
                'metodo'  => $metodo,
                'notas'   => $notas
            ]);
            
            $consulta->closeCursor();
            $conexion = null;
            return true;

        } catch (PDOException $e) {
            error_log("Error al registrarPagoMensual: " . $e->getMessage());
            return false;
        }
    }



}
