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

    public static function comprobarUsuario($email){
        try{
            $resultado = null;
            $conexion = self::conn();
            if(!$conexion) {
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "SELECT * FROM users WHERE user_email = :email";
            $consulta = $conexion -> prepare($sentencia);
            $consulta -> execute (array(":email" => $email));
            $resultado = $consulta -> fetch(PDO::FETCH_OBJ);
            $consulta -> closeCursor();
            $conexion = null;
            return $resultado;
        } catch (PDOException $e) {
            error_log("Error al usar ComprobarUsuario: " . $e -> getMessage());
            return null;

        }
    }
    // Comprobar si ya existe invitación activa
public static function comprobarInvitacion($email) {
    try {
        $conexion = self::conn();
        if (!$conexion) {
            throw new Exception("No se pudo conectar a la base de datos");
        }
        $sentencia = "SELECT * FROM invitations WHERE email = :email AND used = 0 LIMIT 1";
        $consulta = $conexion->prepare($sentencia);
        $consulta->execute([":email" => $email]);
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        $consulta->closeCursor();
        $conexion = null;
        return $resultado ?: null;
    } catch (PDOException $e) {
        error_log("Error al usar comprobarInvitacion: " . $e->getMessage());
        return null;
    }
}

// Crear invitación
    public static function crearInvitacion($email, $token) {
        try {
            $conexion = self::conn();
            if (!$conexion) {
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "INSERT INTO invitations (email, token) VALUES (:email, :token)";
            $consulta = $conexion->prepare($sentencia);
            $resultado = $consulta->execute([
                ":email" => $email,
                ":token" => $token
            ]);
            $consulta->closeCursor();
            $conexion = null;
            return $resultado;
        } catch (PDOException $e) {
            error_log("Error al usar crearInvitacion: " . $e->getMessage());
            return false;
        }
    }




}