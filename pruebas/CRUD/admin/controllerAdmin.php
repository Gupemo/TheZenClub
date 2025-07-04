<?php
include 'DB.php';

class ControllerAdmin{
    public function __construct(){
        if($_SESSION['usuario']['rol'] != "admin") {
            header('location./login.php?login=ko');
            exit();
        }

    }
    public function verMisDatos(){
        $id = $_SESSION['usuario']['id'];
        return DB::buscarID($id);
    }
    
    public static function verTodosUsuarios(){
        $todosUsuarios = DB::verTodos();
        return $todosUsuarios;

    }
}