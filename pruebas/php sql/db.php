<?php

require '.env.php';

class DB{
    
    public static function conn(){
        $errorCon = false;
        $miConexion = new mysqli(HOST, USUARIO, PASS, BD);

        if($miConexion->connect_errno){
            echo "connect error = $miConexion->connect_errno";
            $errorCon = true;
        }
        
/*         if($miConexion == null || $errorCon == true){
            echo "No se ha podído crear el objeto";
        }else{
            echo "Objeto creado";
            echo "<br> server info: $miConexion->server_info";
            echo "<br> host info: $miConexion->host_info";
        } */
       return $miConexion;

    } 

    public static function insertar($nombre, $email, $contrasena) {
        $conexion = self::conn();
        $sentenciaInsert = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombre', '$email', '$contrasena')";
        $result = $conexion->query($sentenciaInsert);
    }

}