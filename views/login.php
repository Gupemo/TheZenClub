<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="keywords"
        content="escuela, bjj, jiu jitsu, jiu jitsu brasileño, brazilian jiu jitsu, las palmas, academia artes marciales, artes marciales">
    <meta name="description" content="Escuela de artes marciales, especializada en Jiu Jitsu brasileño">
    <title>The Zen Club - Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/styles/normalize.css">
    <link rel="stylesheet" href="/assets/styles/styles.css">
    <link rel="manifest" href="/assets/data/manifest.json">
    <link rel="icon" type="image/png" href="/assets/icons/logo.ico">

</head>

<body>
    <div class="contenedor">
        <header class="header">
            <img src="/assets/logo.png" alt="Logo del club" class="header__logo">
        </header>
        <?php
        include '../includes/navBar.php';
        ?>
        <main class="main">
            <section class="section formulario-login">
                <?php

                    if (isset($_GET['login']) && $_GET['login'] === 'error') {
                        ?>
                        <small class="error">Error al intentar loguear.</small>
                        <?php
                    }
                ?>

                <?php

                if(isset($_SESSION['rol'])){
                    ?>
                    <small class="error"> Ya tienes una sesión iniciada, ve a tu <a href="./users/profile.php">perfil</a>
                    <?php
                }else{
                    ?>
                <form action="../MVC/core/router.php" method="POST" class="login-form">

                    <div class="camp">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="camp">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="camp botones">
                        <input type="reset" value="Borrar" class="boton">
                        <input type="submit" name="login" value="Iniciar sesión" class="boton">
                    </div>

                </form>
                <?php
                }
                ?>
            </section>

        </main>
        <?php
        include '../includes/footer.php';
        ?>
</body>
<script src="/assets/js/hamburguesa.js"></script>

</html>