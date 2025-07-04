<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $registro = null;
    if(isset($_GET['registro'])) {
        $registro = $_GET['registro'];
    }

    ?>

    <div>
            <?php 
            echo ($registro == 'ko')?"El usuario ya existe":"" 
            ?>
        <div>
            </div>
        <form id="registro" action="router.php" method="POST">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre">
            </div>
            <div>
                <label for="email">email:</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena">
            </div>
            <div>
                <input type="submit" value="Registrarse" name="registrarse">
            </div>
        </form>
    </div>    
</body>
</html>