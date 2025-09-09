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

        $uploadDir = __DIR__ . "/../assets/users/profilePictures/"; // ruta en tu proyecto
        $extension = strtolower(pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION));

        // seguridad: permitir solo imágenes
        $extPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($extension, $extPermitidas)) {
            $fileName = uniqid("user_") . "." . $extension;
            $filePath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $filePath)) {
                // ruta para guardar en base de datos.
                $user_picture = "assets/users/profilePictures/" . $fileName;
            }
        }
    }
    // datos de usuario
    $userData = [
        'user_name'      => htmlspecialchars($_POST['userName']),
        'user_subname'   => htmlspecialchars($_POST['userSubname']),
        'user_birthdate' => htmlspecialchars($_POST['userBirthDate']),
        'user_email'     => filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL),
        'user_phone'     => htmlspecialchars($_POST['userPhone']),
        'user_sex'       => htmlspecialchars($_POST['userSex']),
        'user_picture'   => $user_picture,
        'user_deseases'  => !empty($_POST['userDeseases']) ? htmlspecialchars($_POST['userDeseases']) : null,
        'user_password'  => password_hash($_POST['userPassword'], PASSWORD_DEFAULT),
        'tos_accepted'   => isset($_POST['conditions']) ? 1 : 0
    ];
    // datos de contacto (si los rellena)
    $dataContact = [
        'contact_name'    => !empty($_POST['userContactName']) ? htmlspecialchars($_POST['userContactName']) : null,
        'contact_subname' => !empty($_POST['userContactSubname']) ? htmlspecialchars($_POST['userContactSubname']) : null,
        'contact_phone'   => !empty($_POST['userContactPhone']) ? htmlspecialchars($_POST['userContactPhone']) : null,
        'parentesco'      => !empty($_POST['kindship']) ? htmlspecialchars($_POST['kindship']) : null
    ];


    $controlador = new ControllerUsers(); 
    $resultado = $controlador->registrarUsuario($userData, $dataContact);

    unset($controlador);
    if ($resultado) {
        header('Location: ../../views/users/profile.php?registro=ok');
        exit();
    } else {
        header('Location: ../../views/registro.php?registro=error');
        exit();
    }
}
