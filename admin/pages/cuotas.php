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

    <?php
    require_once '../../config/debug.php';
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
                <li class="nav-link"><a href="../index.php">Inicio</a></li>
                <li class="nav-link"><a href="#">Noticias</a></li>
            </ul>
        </nav>

        <!-- Contenido -->
        <div class="contenedor">
            <?php if (isset($_GET['invitar'])): ?>
                <?php if ($_GET['invitar'] === 'ok'): ?>
                    <p style="color:green;">✅ Invitación creada correctamente</p>
                <?php elseif ($_GET['invitar'] === 'error'): ?>
                    <p style="color:red;">❌ No se pudo crear la invitación</p>
                <?php elseif ($_GET['invitar'] === 'invalid'): ?>
                    <p style="color:red;">⚠️ El email no es válido</p>
                <?php endif; ?>
            <?php endif; ?>

            <?php
            $action = $_GET['action'] ?? null;
            switch ($action) {
                case 'listar':
                    include '../includes/listar/listar_cuotas.php';
                    break;
                case 'listarInvitaciones':
                    include '../includes/listarInvitaciones.php';
                    break;
                default:
                    include '../includes/listarUsuarios.php';
                    break;
            }
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