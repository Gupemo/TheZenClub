<?php
require_once __DIR__ . '/../../config/.env.php';

// conexion a la base de datos.
class Conexion{
    
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

}
