<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="keywords"
        content="escuela, bjj, jiu jitsu, jiu jitsu brasileño, brazilian jiu jitsu, las palmas, academia artes marciales, artes marciales">
    <meta name="description" content="Escuela de artes marciales, especializada en Jiu Jitsu brasileño">
    <title>The Zen Club - Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/styles/normalize.css">
    <link rel="stylesheet" href="../assets/styles/styles.css">
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
            <article class="articulo articulo__nosotros">
                <div class="nosotros__contenido">
                    <h2>Sobre nosotros</h2>

                    <p>En <strong>The Zen Club</strong> entendemos el Jiu Jitsu como una herramienta de crecimiento personal. Nuestra enseñanza se basa en el respeto, la constancia y el control.</p>

                    <p>Cada clase es una oportunidad para superarte, aprender a tu ritmo y formar parte de una comunidad donde se valora tanto la técnica como el compañerismo.</p>

                    <p>El entrenamiento está abierto a todas las edades: también contamos con clases para niños y juveniles, donde aprenderán disciplina, respeto, defensa personal y los fundamentos de este arte marcial, todo en un entorno seguro, dinámico y divertido.</p>

                    <p>No importa tu edad, condición física o experiencia previa: aquí entrenamos juntos, progresamos juntos y celebramos cada avance como un paso más hacia tu mejor versión.</p>

                </div>
                <div class="nosotros__imagen">
                    <img src="../assets/images/dojo-tatami.jpeg" alt="Imagen de nuestras instalaciones">

                </div>


            </article>
        </main>
        <?php
        include '../includes/footer.php';
        ?>
</body>

</html>