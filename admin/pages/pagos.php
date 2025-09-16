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
            <article class="pagos">
                <h2>Registrar pagos</h2>

                <!-- Buscador -->
                <form action="../../MVC/core/router.php" method="POST" class="buscador">
                    <input type="text" name="busqueda" placeholder="Buscar usuario por nombre..." required>
                    <input type="submit" name="buscarUsuario" value="Buscar">
                </form>

                <?php if (isset($usuarios) && count($usuarios) > 0): ?>
                    <form action="../../MVC/core/router.php" method="POST" class="formPagos">
                        <table class="tablaPagos">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Cuota</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><input type="checkbox" name="usuarios[]" value="<?= $usuario->user_id ?>"></td>
                                        <td><?= htmlspecialchars($usuario->user_name . " " . $usuario->user_subname) ?></td>
                                        <td><?= htmlspecialchars($usuario->user_email) ?></td>
                                        <td><?= htmlspecialchars($usuario->cuota_name) ?></td>
                                        <td><?= $usuario->amount ?> €</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Campos comunes para todos los pagos -->
                        <div class="campo">
                            <label for="payment_method">Método</label>
                            <input type="text" name="payment_method" id="payment_method" placeholder="Efectivo, tarjeta..." required>
                        </div>

                        <div class="campo">
                            <label for="payment_notes">Notas</label>
                            <textarea name="payment_notes" id="payment_notes"></textarea>
                        </div>

                        <div class="campo">
                            <input type="submit" name="registrarPagos" value="Registrar pagos">
                        </div>
                    </form>
                <?php elseif (isset($usuarios)): ?>
                    <p>No se encontraron usuarios activos con ese nombre.</p>
                <?php endif; ?>
            </article>

        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>© 2025 The Zen Club - Panel de administración</p>
            <p>http://github.com/gupemo</p>
        </footer>
    </main>
</body>

</html>