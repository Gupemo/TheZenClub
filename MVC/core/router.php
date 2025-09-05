<?php

/**
 * Router principal donde se controla registro, login y todo lo que conecte con base de datos.
 */

// indispensables
/* require_once '../controllers/controllerLogin.php';
require_once '../controllers/controllerProfile.php';
require_once '../controllers/controllerNews.php'; */
require_once '../controllers/controllerInvites.php';
require_once '../../config/debug.php';

// iniciando sesion
session_start();


// invitacion de usuarios

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['invitarUsuario'])) {
    $email = $_POST['email'];
    // validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../../admin/pages/users.php?action=invitar&invitar=invalid');
        exit();
    }

    $controller = new ControllerInvites();
    $resultado = $controller -> invitarUsuario($email);
    unset($controller);

    if($resultado) {
        header('Location: ../../admin/pages/users.php?invitar=ok');
        exit();
    }else{
        header('Location: ../../admin/pages/users.php?invitar=error');
        exit();
    }

}
