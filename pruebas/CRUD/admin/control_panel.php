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

    $cliente = null;
    $datos = null;

    if(isset($_SESSION['usuario'])) {
        $datos = $_SESSION['usuario'];        
    }
    // el print para ver el array.
    // print_r($datos);
    // echo "Bienvenid@ " . $datos[1];
    if ($datos['rol'] == 'admin'){
        //si es admin
        echo "hola Admin";
        include './controllerAdmin.php';
        $cliente = new ControllerAdmin();
        // si es admin carga la clase admin

    } elseif($datos['rol']== 'user'){
        include './controllerClient.php';
        $cliente = new ControllerClient();
        //si es user carga la clase client
        echo "hola user.";
        //si es user

    }else{
        // si no es nada redirect a la página de login
        header('location:../login.php');
        exit();         

    }

    if($datos['rol'] == 'admin'){
        ?>
        <h1>panel de control</h1>
        <a href="router.php?pag=inserta">Nuevo usuario</a>
        <hr>
        <a href="router.php?pag=actualizar">Actualizar</a>
        <hr>
        <a href="router.php?datos=todos">Ver todos los clientes</a>
        <hr>
        
        
        
        <?php
        //print_r($cliente->verTodosUsuarios());
    }
    if($datos['rol'] == 'user'){
        ?>
        <a href="#">Ver todos los clientes</a>

        <?php
        echo '<br>';
        print_r($cliente->verMisDatos());

    }

    
    ?>
    <a href="router.php?session=ko">Cerrar sesión</a>

    
</body>
</html>