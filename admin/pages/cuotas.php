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
    <?php
/*      if (!isset($_SESSION['rol_id'])) {
    header('Location: ../index.php');
    exit;
} */
    ?>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/debug.php';
    ?>

</head>

<body>
    <main class="main">
        <!-- Header -->
        <header class="header">
            <h1>Panel de administración</h1>
            <!-- Navbar -->
            <?php
            include '../includes/panelNavbar.php';
            ?>
        </header>

        <!-- Contenido -->
        <div class="contenedor">
            <?php
            $mensajes = [
                // Borrar
                'borrar_ok'       => ['color' => 'green', 'icono' => '✅', 'texto' => 'Cuota eliminada correctamente'],
                'borrar_error'    => ['color' => 'red',   'icono' => '❌', 'texto' => 'No se pudo borrar la cuota'],
                'borrar_nodfault' => ['color' => 'red',   'icono' => '⚠️', 'texto' => 'No se puede eliminar la cuota que se asigna por defecto'],

                // Editar
                'editar_ok'    => ['color' => 'green', 'icono' => '✅', 'texto' => 'Cuota editada correctamente'],
                'editar_error' => ['color' => 'red',   'icono' => '❌', 'texto' => 'No se pudo editar la cuota'],

                // Crear
                'crear_ok'    => ['color' => 'green', 'icono' => '✅', 'texto' => 'Cuota creada correctamente'],
                'crear_error' => ['color' => 'red',   'icono' => '❌', 'texto' => 'No se pudo crear la cuota'],
            ];

            foreach (['borrar', 'editar', 'crear'] as $accion) {
                if (isset($_GET[$accion])) {
                    $clave = $accion . '_' . $_GET[$accion];
                    if (isset($mensajes[$clave])) {
                        $m = $mensajes[$clave];
                        echo '<p style="color:' . htmlspecialchars($m['color']) . ';">' .
                            $m['icono'] . ' ' . htmlspecialchars($m['texto']) .
                            '</p>';
                    }
                }
            }
            ?>

            <?php
            $action = $_GET['action'] ?? null;
            switch ($action) {
                case 'listar':
                    include '../includes/listar/listar_cuotas.php';
                    break;
                case 'editar':
                    include '../includes/editar/editar_cuotas.php';
                    break;
                case 'crear':
                    include '../includes/crear/crear_cuotas.php';
                    break;
                case 'pagosok':
                    include '../includes/listar/listar_cuotasok.php';
                    break;
                case 'pagospendientes':
                    include '../includes/listar/listar_cuotaspendientes.php';
                    break;
                case 'asignarCuotas':
                    include '../includes/gestion/gestion_asignarCuotas.php';
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
