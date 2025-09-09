<?php
require_once './conexion';

// CRUD DE USERS
class Users{

    public static function obtenerEmail($email){
        try{
            $conexion = Conexion::conn();
            if(!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "SELECT * FROM WHERE user_email = :email";
            $consulta = $conexion -> prepare($sentencia);
            $consulta -> execute(array(":email" => $email));
            $resultado = $consulta -> fetch(PDO::FETCH_OBJ);
            $conexion = null;
            $consulta -> closeCursor();
            return $resultado;

        } catch (PDOException $e) {
            error_log("Error al usar obtenerEmail: " . $e->getMessage());
            return null;
        }
    }

    public static function registrarUsuario($userData, $dataContact){
        
    }

}