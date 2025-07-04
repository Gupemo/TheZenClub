<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $login = null;
    if (isset($_GET['login'])) {
        $login = $_GET['login'];
    }
    ?>

    <div>
        <div>
            <div>
                <?php
                echo ($login =='ko')?"Los datos son incorrectos":" ";
                ?>
            </div>
            <form id="login" action="./router.php" method="POST">
                <div>
                    <label for="email">email:</label>
                    <input type="email" name="email" id="email">
                </div>
                <div>
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" id="contrasena">
                </div>
                <div>
                    <input type="submit" value="acceder" name="login">
                </div>

            </form>
        </div>
        <div>
            <a href="registro.php">Registrarse</a>
        </div>
    </div>

</body>

</html>