<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="/assets/styles/panel.css">
</head>

<body>
    <main class="main">
        <!-- Header -->
        <header class="header">
            <h1>Panel de administración</h1>
            <?php
            include './includes/panelNavbar.php';
            ?>
        </header>

        <!-- Contenido -->
        <div class="contenedor">
            <p>Aquí irá el contenido dinámico del panel.</p>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2025 The Zen Club - Panel de administración</p>
            <p>http://github.com/gupemo</p>
        </footer>
    </main>
</body>

</html>
