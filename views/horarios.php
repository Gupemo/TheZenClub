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
            <article class="articulo">
                <h1>Nuestros horarios</h1>

                <p><strong>Nuestros horarios están diseñados para adaptarse a todos los niveles y edades, en un ambiente responsable y familiar.</strong></p>

                <p>En nuestro dojo, el Jiu Jitsu se practica con compromiso y respeto, fomentando la mejora continua y la camaradería.</p>

                <p>Los lunes y miércoles, las clases de adultos se dividen en grupos de principiantes y avanzados, para que cada alumno pueda progresar a su ritmo.</p>

                <p>El horario completo está siempre disponible, pero puedes usar el selector para ver solo las clases que más te interesan: infantil, juveniles, adultos o MMA. Así encontrarás fácilmente el horario que mejor se adapte a ti.</p>

                <label for="selectSchedule">Selecciona el horario: </label>
                <select name="selectSchedule" id="selectSchedule">
                    <option value="completo">Horario Completo</option>
                    <option value="infantil">BJJ Infantil</option>
                    <option value="juveniles">BJJ Juveniles</option>
                    <option value="adultos">BJJ Adultos</option>
                    <option value="mma">MMA</option>
                </select>

                <div id="schedule-table" class="schedule-table"></div>
            </article>
        </main>
        <?php include __DIR__ . '/../includes/footer.php'; ?>
    </div>
    <script src="/assets/js/hamburguesa.js"></script>
    <script src="/assets/js/schedule.js"></script>
</body>
</html>
