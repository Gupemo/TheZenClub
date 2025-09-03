<?php
require_once __DIR__ . '/../../config/.env.php';

// clase completa con todas las consultas a base de datos
class DB{
    
    // conexion
    public static function conn(){
        try{
            $conn = new PDO("mysql:host=" . DBSERVER . ";dbname=" . DBNAME, DBUSER, DBPASSWORD);
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch (PDOException $e){
            error_log("Fallo al conectar a la base de datos: " . $e -> getMessage());
    
        }
    }

    // comprobar si el email existe:
// comprobar si el email existe:
    public static function comprobarUsuario($email){
        try{
            $conexion = self::conn();
            if (!$conexion) {
                throw new Exception("No se pudo conectar a la base de datos");
            }

            $sentencia = "SELECT * FROM users WHERE user_email = :email";
            $consulta = $conexion->prepare($sentencia);
            $consulta->execute([':email' => $email]);
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            $consulta->closeCursor();
            $conexion = null;

            return $resultado ?: false;

        } catch (PDOException $e) {
            error_log("Error al usar comprobarUsuario: " . $e->getMessage());
            return false;
        }
    }


}