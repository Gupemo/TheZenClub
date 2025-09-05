<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="/assets/styles/panel.css">
    <?php
    /* if (!isset($_SESSION['rol_id'])) {
    header('Location: ../index.php');
    exit;
}

$accessLevel = $_SESSION['rol_id'];

switch ($accessLevel) {
    case 1: // usuario normal -> fuera del panel
        header('Location: ../index.php');
        exit;
    case 2: // instructor
    case 3: // profesor
        include '../includes/acp/panel_profesor.php';
        break;
    case 4: // maestro
        include '../includes/acp/panel_maestro.php';
        break;
    default:
        header('Location: ../index.php');
        exit;
}*/
    ?>

</head>

<body>
    <main class="main">
        <!-- Header -->
        <header class="header">
            <h1>Panel de administración</h1>
        </header>

        <!-- Navbar -->
        <nav class="navbar">
            <ul>
                <li class="nav-link"><a href="#">Inicio</a></li>
                <li class="nav-link"><a href="#">Noticias</a></li>
            </ul>
        </nav>

        <!-- Contenido -->
        <div class="contenedor">
            <?php
            $acciones = ['borrado', 'creacion', 'editar'];

            foreach ($acciones as $accion) {
                if (isset($_GET[$accion])) {
                    $estado = $_GET[$accion];
                    echo '<article class="article">';
                    switch ($estado) {
                        case 'ok':
                            echo "<p style='color: green;'>✅ Acción de <strong>$accion</strong> realizada correctamente.</p>";
                            break;
                        case 'error':
                            echo "<p style='color: red;'>❌ Error al realizar la acción de <strong>$accion</strong>.</p>";
                            break;
                        default:
                            echo "<p>⚠️ Estado desconocido para la acción <strong>$accion</strong>.</p>";
                            break;
                    }
                    echo '</article>';
                }
            }
            
            include '../includes/acp/panel_maestro.php';
            ?>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>© 2025 The Zen Club - Panel de administración</p>
            <p>http://github.com/gupemo</p>
        </footer>
    </main>
</body>

</html>