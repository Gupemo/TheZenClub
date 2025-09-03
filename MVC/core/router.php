<?php

/**
 * Router principal donde se controla registro, login y todo lo que conecte con base de datos.
 */

// indispensables
require_once '../controllers/controllerLogin.php';
require_once '../controllers/controllerProfile.php';
require_once '../controllers/controllerNews.php';

// iniciando sesion
session_start();

// registro de usuarios

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro'])) {

    // Validar email
    if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
        die('El email no es válido.');
    }

    // Procesar imagen de perfil
    $imagenNombreFinal = 'no-profile.jpg';
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
        $nombreTmp = $_FILES['profilePicture']['tmp_name'];
        $extension = strtolower(pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($extension, $permitidas)) {
            $nombreSeguro = uniqid('user_') . '.' . $extension;
            $rutaDestino = __DIR__ . '/../assets/images/profile_images/' . $nombreSeguro;

            if (move_uploaded_file($nombreTmp, $rutaDestino)) {
                $imagenNombreFinal = $nombreSeguro;
            }
        }
    }

    $userData = [
        'user_name'         => htmlspecialchars(trim($_POST['userName'])),
        'user_subname'      => htmlspecialchars(trim($_POST['userSubname'])),
        'user_birthdate'    => $_POST['userBirthDate'],
        'user_email'        => filter_var(trim($_POST['userEmail']), FILTER_SANITIZE_EMAIL),
        'user_phone'        => htmlspecialchars(trim($_POST['userPhone'])),
        'user_sex'          => $_POST['userSex'],
        'user_password'     => password_hash($_POST['userPassword'], PASSWORD_BCRYPT),
        'user_deseases'     => htmlspecialchars(trim($_POST['userDeseases'])),
        'tos_accepted'      => isset($_POST['conditions']) ? 1 : 0,
        'user_picture'      => $imagenNombreFinal
    ];

    // contactos de emergencia
    $userContactData = null;
    if (!empty($_POST['userContactName']) && !empty($_POST['userContactPhone'])) {
        $userContactData = [
            'contact_name'     => htmlspecialchars(trim($_POST['userContactName'])),
            'contact_subname'  => htmlspecialchars(trim($_POST['userContactSubname'] ?? '')),
            'contact_phone'    => htmlspecialchars(trim($_POST['userContactPhone']))
        ];
    }

    $ins = new controllerLogin();
    $ins -> registrarUsuario($userData, $userContactData);
    
    unset($ins);

    if($resultado){
        header('Location: ../../index.php?registro=ok');
        exit();
    }else{
        header('Location: ../../views/registro.php?registro=error');
        exit();
    }

    
}
