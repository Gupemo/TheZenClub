<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    session_start();
    $datos = null;

    if (isset($_SESSION['usuario'])) {
        $datos = $_SESSION['usuario'];
    }else{
        echo "no tienes acceso.";
    }
    if ($datos['rol'] == "admin") {
        include './controllerAdmin.php';
        $cliente = new ControllerAdmin;
        $todos = $cliente->verTodosUsuarios();


        foreach($todos as $value){
            ?>
            <span><?php echo $value->id ?></span>
            <a href="router.php?pag=detalle&id=<?php echo $value->id; ?>"><?php echo $value->nombre ?></a> <?php echo $value->rol ?>
            <a href="router.php?pag=borrado&id=<?php echo $value->id ?>">Borrar</a>
            <a href="router.php?pag=actualizar&id=<?php echo $value->id ?>">Actualizar</a>
            <br>
            <?php
        }
        ?>
        <a href="<?php ?>"><?php ?></a>
        

        <?php
    }else{
        echo "no tienes acceso";
        exit();
    }
    echo 'listado';

    ?>





    
</body>
</html>