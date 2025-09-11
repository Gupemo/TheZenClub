<?php

require_once 'conexion.php';

// CRUD de cuotas

class Fees{

    // listar las cuotas
    public static function listaCuotas(){
            try{
            $conexion = conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "SELECT * FROM fees";
            $consulta = $conexion -> prepare($sentencia);
            $consulta -> execute();
            $resultado = $consulta -> fetchAll(PDO::FETCH_OBJ);

            $consulta -> closeCursor();
            $conexion = null;
            return $resultado;

        } catch (PDOException $e){
            error_log("Error al usar listaCuotas: " . $e -> getMessage());
            return false;
        }
    }

    // borrar la cuota, usando su id
    public static function borrarCuota($fee_id){
        try{
            $conexion = conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "DELETE FROM fees WHERE fee_id = :fee_id";
            $consulta = $conexion -> prepare($sentencia);
            $consulta -> execute(["fee_id" => $fee_id]);

            $consulta -> closeCursor();
            $conexion = null;
            return true;
        } catch (PDOException $e){
            error_log("Error al usar BorrarCuota: " . $e -> getMessage());
            return false;
        }
    }

    public static function obtenerCuota($fee_id){
        try{
            $conexion = conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "SELECT * FROM fees WHERE fee_id = :fee_id";
            $consulta = $conexion -> prepare($sentencia);
            $consulta -> execute(["fee_id" => $fee_id]);
            $resultado = $consulta -> fetch(PDO::FETCH_OBJ);

            $consulta -> closeCursor();
            $conexion = null;
            return $resultado;
        } catch (PDOException $e){
            error_log("Error al usar BorrarCuota: " . $e -> getMessage());
            return false;
        }
    }

    //editar cuotas usando id
    public static function editarCuota($datosCuota){
        try{
            $conexion = conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "UPDATE fees SET name = :name, amount = :amount WHERE fee_id = :fee_id  " ;
            $consulta = $conexion -> prepare($sentencia);
            $consulta -> execute([
                "fee_id" => $datosCuota['fee_id'],
                "name" => $datosCuota['name'],
                "amount" => $datosCuota['amount']
            ]);

            $consulta -> closeCursor();
            $conexion = null;
            return true;
        } catch (PDOException $e){
            error_log("Error al usar BorrarCuota: " . $e -> getMessage());
            return false;
        }
    }

    // crear cuota
    public static function crearCuota($datosCuota){
        try{
            $conexion = conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "INSERT INTO fees (name, amount) VALUES (:name, :amount)";
            $consulta = $conexion -> prepare($sentencia);
            $consulta -> execute([
                "name" => $datosCuota['name'],
                "amount" => $datosCuota['amount']
            ]);

            $consulta -> closeCursor();
            $conexion = null;
            return true;
        } catch (PDOException $e){
            error_log("Error al usar BorrarCuota: " . $e -> getMessage());
            return false;
        }
    }

}