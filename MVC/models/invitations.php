<?php
require_once 'conexion.php';
class Invites{
    // Crear invitación
    public static function comprobarUsuario($email){
        try{
            $resultado = null;
            $conexion = Conexion::conn();
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
        $conexion = Conexion::conn();
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
            $conexion = Conexion::conn();
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
    
    // obtener invitaciones activas (SIN USAR)
    public static function obtenerInvitaciones(){
        try {
            $conexion = Conexion::conn();
            if (!$conexion){
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "SELECT * FROM invitations ORDER BY created_at DESC";
            $consulta = $conexion -> prepare($sentencia);
            $consulta -> execute();
            $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
            $consulta -> closeCursor();
            $conexion = null;
            return $resultado;

        } catch (PDOException $e){
            error_log("Error al usar ObtenerInvitaciones: " . $e -> getMessage());
            return null;
        }

    }

    // para comprobar el token
    public static function comprobarToken($token){
        try {
            $conexion = Conexion::conn();
            if (!$conexion) {
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "SELECT * FROM invitations WHERE token = :token AND used = 0 LIMIT 1";
            $consulta = $conexion->prepare($sentencia);
            $consulta->execute([":token" => $token]);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            $consulta->closeCursor();
            $conexion = null;
            return $resultado;
        } catch (PDOException $e) {
            error_log("Error al usar comprobarToken: " . $e->getMessage());
            return null;
        }
    }

    public static function obtenerPorId($id) {
        try {
            $conexion = Conexion::conn();
            if (!$conexion) {
                throw new Exception("No se pudo conectar a la base de datos");
            }
            $sentencia = "SELECT * FROM invitations WHERE id = :id LIMIT 1";
            $consulta = $conexion->prepare($sentencia);
            $consulta->execute([":id" => $id]);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            $consulta->closeCursor();
            $conexion = null;
            return $resultado ?: null;
        } catch (PDOException $e) {
            error_log("Error al usar obtenerPorId: " . $e->getMessage());
            return null;
        }
    }



}