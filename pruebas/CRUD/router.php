<?php

include './controllerLogin.php';

if($_POST['registrarse']){
   $nombre = htmlspecialchars($_POST['nombre']);
   $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
   $pass = htmlspecialchars($_POST['contrasena']);
   $contrasena = password_hash($pass, PASSWORD_BCRYPT);

   $ins = new ControllerLogin();
   $ins->insertarUsuario($nombre, $email, $contrasena);
   unset($ins);

}

if($_POST['login']) {
   $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
   $contrasena = htmlspecialchars($_POST['contrasena']);
   $log = new ControllerLogin();
   $log->login($email,$contrasena);
   unset($log);

}
