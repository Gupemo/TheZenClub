<?php

/**
 * Router principal donde se controla registro, login y todo lo que conecte con base de datos.
 */

// indispensables
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/controllers/controllerInvites.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC//controllers/controllerUsers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/controllers/controllerPayments.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/controllers/controllerAuth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/controllers/controllerFee.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/debug.php';

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
        header('Location: ../../admin/pages/users.php?action=invitar&invitar=ok');
        exit();
    }else{
        header('Location: ../../admin/pages/users.php?action=invitar&invitar=error');
        exit();
    }

}

// registro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro'])) {

    //imagen de perfil
    $user_picture = null;

    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {

        $uploadDir = __DIR__ . "/../../public/users/profilePictures/";

        if(!is_dir($uploadDir)){
            mkdir($uploadDir, 0777, true);
        
        }
        $extension = strtolower(pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION));

        // seguridad: permitir solo imágenes
        $extPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($extension, $extPermitidas)) {
            $fileName = uniqid("user_") . "." . $extension;
            $filePath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $filePath)) {
                // ruta para guardar en base de datos.
                $user_picture = "/public/users/profilePictures/" . $fileName;
            }
        }
    }
    // datos de usuario
    $userData = [
        'user_name'         => htmlspecialchars($_POST['userName']),
        'user_subname'      => htmlspecialchars($_POST['userSubname']),
        'user_birthdate'    => htmlspecialchars($_POST['userBirthDate']),
        'user_email'        => filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL),
        'user_phone'        => htmlspecialchars($_POST['userPhone']),
        'user_sex'          => htmlspecialchars($_POST['userSex']),
        'user_picture'      => $user_picture,
        'user_deseases'     => !empty($_POST['userDeseases']) ? htmlspecialchars($_POST['userDeseases']) : null,
        'user_password'     => password_hash($_POST['userPassword'], PASSWORD_DEFAULT),
        'tos_accepted'      => isset($_POST['conditions']) ? 1 : 0,
    ];
    // datos de contacto (si los rellena)
    $dataContact = [
        'contact_name'    => !empty($_POST['userContactName']) ? htmlspecialchars($_POST['userContactName']) : null,
        'contact_subname' => !empty($_POST['userContactSubname']) ? htmlspecialchars($_POST['userContactSubname']) : null,
        'contact_phone'   => !empty($_POST['userContactPhone']) ? htmlspecialchars($_POST['userContactPhone']) : null,
        'relationship'      => !empty($_POST['kindship']) ? htmlspecialchars($_POST['kindship']) : null
    ];
    
    $token = htmlspecialchars($_POST['token']);

    $controlador = new ControllerUsers(); 
    $resultado = $controlador->registrarUsuario($userData, $dataContact, $token);

    unset($controlador);

    if ($resultado) {
        session_regenerate_id(true); // regenero la id para evitar fijación de sesión

        $_SESSION['user_id']   = $resultado;              // ID del usuario
        $_SESSION['user_name'] = $userData['user_name'];  // nombre del formulario
        $_SESSION['rol']       = 1;                       // rol por defecto

        header('Location: ../../views/users/profile.php?registro=ok');
        exit();
    } else {
        header('Location: ../../views/registro.php?registro=error');
        exit();
    }
}




//login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
    $loginData = [
        'email' => htmlspecialchars($_POST['email']),
        'password' => htmlspecialchars($_POST['password'])
    ];

    $controlador = new ControllerAuth();
    $resultado = $controlador -> login($loginData);
    unset($controlador);

    if ($resultado){
        header('Location: ../../views/users/profile.php?login=ok');
        exit();
    } else {
        header('Location: ../../views/login.php?login=error');
        exit();
    }

}

// borrar cuotas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrarCuota'])) {
    $fee_id = (int) $_POST['fee_id']; 

    if ($fee_id === 1) {
        // No permitir borrar la cuota por defecto
        header('Location: ../../admin/pages/cuotas.php?action=listar&borrar=nodfault');
        exit();
    }

    $controlador = new ControllerFee();
    $resultado = $controlador->borrarCuota($fee_id);
    unset($controlador);

    if ($resultado) {
        header('Location: ../../admin/pages/cuotas.php?action=listar&borrar=ok');
        exit();
    } else {
        header('Location: ../../admin/pages/cuotas.php?action=listar&borrar=error');
        exit();
    }
}

// editar cuotas
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editarCuota'])){
    $datosCuota = [
        "fee_id"    => (int)htmlspecialchars($_POST['fee_id']),
        "name"      => htmlspecialchars($_POST['name']),
        "amount"    => htmlspecialchars($_POST['amount'])
    ];

    $controlador = new ControllerFee();
    $resultado = $controlador -> editarCuota($datosCuota);
    unset($controlador);

    if($resultado){
        header('Location: ../../admin/pages/cuotas.php?action=listar&editar=ok');
        exit();
    } else {
        header('Location: ../../admin/pages/cuotas.php?action=listar&editar=error');
        exit();
    }
}
// crear cuota
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crearCuota'])){
    $datosCuota = [
        "name" => htmlspecialchars($_POST['name']),
        "amount" => htmlspecialchars($_POST['amount'])
    ];

    $controlador = new ControllerFee();
    $resultado = $controlador -> crearCuota($datosCuota);
    unset($controlador);

    if($resultado){
        header('Location: ../../admin/pages/cuotas.php?action=listar&crear=ok');
        exit();
    } else {
        header('Location: ../../admin/pages/cuotas.php?action=listar&crear=error');
        exit();
    }
}
// reenviar invitacion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reenviarInvitaciones'])) {
    if (!empty($_POST['enviar'])) {
        $controller = new ControllerInvites();

        foreach ($_POST['enviar'] as $id) {
            $controller->reenviarInvitacion($id); 
        }
    }
    header('Location: ../../admin/pages/invites.php?action=listarInvitaciones&reenviar=ok');
    exit();
}