<?php

if ($_GET['session'] == "ko") {
    session_destroy();
    header('location:../login.php');
    exit();
}

if($_GET['datos'] == "todos") {
    header('location:./listatodos.php');
}
if($_GET['pag'] == "detalle"){
    header('location:./detalle.php?id=' . $_GET['id']);
}
if($_GET['pag'] == "borrado"){
    header('location:./borrado.php?id=' . $_GET['id']);
}
if($_GET['pag'] == "inserta"){
    header('location:./insertar_actualizar.php?id=no');
}
if($_GET['pag'] == "actualizar"){
    header('location:./insertar_actualizar.php?id=' . $_GET['id']);
}



/*
<?php
if (!isset($_GET['action'])) {
    echo "Acción no especificada";
    exit();
}

switch ($_GET['action']) {
    case 'logout':
        session_destroy();
        header('location:../login.php');
        break;

    case 'listar':
        header('location:./listatodos.php');
        break;

    case 'detalle':
        if (isset($_GET['id'])) {
            header('location:./detalle.php?id=' . $_GET['id']);
        } else {
            echo "ID no proporcionado";
        }
        break;

    case 'borrado':
        if (isset($_GET['id'])) {
            header('location:./borrado.php?id=' . $_GET['id']);
        } else {
            echo "ID no proporcionado";
        }
        break;

    default:
        echo "Acción no válida";
        break;
}
exit();
 */