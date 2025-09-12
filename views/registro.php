<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="keywords"
        content="escuela, bjj, jiu jitsu, jiu jitsu brasileño, brazilian jiu jitsu, las palmas, academia artes marciales, artes marciales">
    <meta name="description" content="Escuela de artes marciales, especializada en Jiu Jitsu brasileño">
    <title>The Zen Club - Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/styles/normalize.css">
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="manifest" href="./assets/data/manifest.json">
    <link rel="icon" type="image/png" href="/assets/icons/logo.ico">

</head>

<body>
    <div class="contenedor">
        <header class="header">
            <img src="/assets/logo.png" alt="Logo del club" class="header__logo">
        </header>
        <?php
        include '../includes/navBar.php';
        require_once '../MVC/controllers/controllerInvites.php';
        ?>
        <main class="main">
            <section class="section">
                <h1>
                    Registro
                </h1>
                <?php 
                // compruebo el token
                $token = $_GET['token'] ?? null;
                $controlador = new ControllerInvites();
                $controlador -> comprobarToken($token);
                if(!$token) {
                    echo 'No puedes registrarte sin invitación';
                    exit();
                }
                $invitacion = $controlador -> comprobarToken($token);

                if($invitacion) {
                    // si el token es valido, carga el registro
                    include '../includes/registro.php';
                }else{
                    echo "El token no es válido o ya fue utilizado";

                }

                ?>

                
            </section>
        </main>
        
        <?php include __DIR__ . '/../includes/footer.php'; ?>
    </div>

    <script src="../assets/js/hamburguesa.js"></script>
    <script src="/assets/js/form.js"></script>
    <script src="../assets/js/terms.js"></script>
</body>
</html>