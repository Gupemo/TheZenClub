<?php

require_once 'conexion.php';

class Fees{
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
}