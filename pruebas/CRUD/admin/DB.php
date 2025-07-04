<?php

include '../.env.php';

class DB{
    public function __construct() {
            if($_SESSION['usuario']['rol'] != 'user' || $_SESSION['usuario']['rol'] != 'admin') {
            header('location./login.php');
            exit();
        }
    }
    public static function conn() {

        try {
            $conn = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . BD, USUARIO, PASSWORD);
            //$conn = new PDO("mysql:host=localhost;dbname=registro_usuarios", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Ha fallado la conexion" . $e->getMessage();
        }

    }
    /**
     * Comprueba que el user existe y devuelve un array con los registros guardados.
     */

     public static function comprobarUsuario($email){
        $result = [];
        $conexion = self::conn();
        $sentencia = "SELECT * FROM usuarios WHERE email = :email";
        $consulta = $conexion->prepare($sentencia);
        $consulta->execute(array(":email" => $email));
        while ($fila = $consulta->fetch(PDO::FETCH_OBJ)){
            array_push($result, $fila);
        }
        $consulta->closeCursor();
        $conexion = null;
        return $result;
     }

     /**
      * Ver todos los usuarios registrados en BD.
      */

     public static function verTodos() {
        $result = [];
        $conexion = self::conn();
        $sentencia = "SELECT * FROM usuarios";
        $consulta = $conexion->prepare($sentencia);
        $consulta->execute();
        while ($fila = $consulta->fetch(PDO::FETCH_OBJ)) {
            array_push($result, $fila);
        }
        $consulta->closeCursor();
        $conexion = null;
        return $result;

     }
       
     public static function insertar($nombre, $email, $contrasena) {
        $conexion = self::conn();
        $sentencia = 'INSERT INTO usuarios (nombre, email, contrasena, rol) VALUES (:nombre, :email, :contrasena, :rol)';
        $rol = "user";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bindParam(":nombre", $nombre);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":contrasena", $contrasena);
        $consulta->bindParam(":rol", $rol);
        $consulta->execute();
        $consulta->closeCursor();
        $conexion = null;
        //echo "Registro correcto";
     }

     /**
      * Actualizar el nombre de usuario
      */
     public static function actualizarNombre($nuevoNombre, $nombre) {
        $conexion = self::conn();
        $sentencia = "UPDATE usuarios SET nombre = :nuevoNombre WHERE nombre = :nombre";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bindParam(":nombre", $nombre);
        $consulta->bindParam(":nuevoNombr", $nuevoNombre);
        $consulta->execute();
        $consulta->closeCursor();
        $conexion = null;
        //echo "Actualizado";
     }

     /**
      * Borrar
      */

     public static function borrar($nombre) {
        $conexion = self::conn();
        $sentencia = "DELETE FROM usuarios WHERE nombre = :nombre";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bindParam(":nombre", $nombre);
        $consulta->execute();
        $consulta->closeCursor();
        $conexion = null;
        //echo "Borrado"
     }

    public static function buscarID($id){
        $result = [];
        $conexion = self::conn();
        $sentencia = "SELECT * FROM usuarios WHERE id = :id";
        $consulta = $conexion->prepare($sentencia);
        $consulta->execute(array(':id' => $id));
        while ($fila = $consulta->fetch(PDO::FETCH_OBJ)){
            array_push($result, $fila);
        } 
        $consulta->closeCursor();
        $conexion = null;
        return $result;

    }

    public static function borrarId($id) {
    $conexion = self::conn();
    $sentencia = "DELETE FROM usuarios WHERE id = :id";
    $consulta = $conexion->prepare($sentencia);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $consulta->closeCursor();
    $conexion = null;
    //echo "Borrado"
    }


}