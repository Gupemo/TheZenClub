
<?php
require_once '../../MVC/controllers/controllerInvites.php';
$controlador = new ControllerInvites();
$invitaciones = $controlador ->listarInvitaciones();
?>

<h2>Listado de invitaciones</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Email</th>
        <th>Token</th>
        <th>Enlace</th>
        <th>Estado</th>
        <th>Enviar</th>
    </tr>

    <?php if (!empty($invitaciones)): ?>
        <?php foreach ($invitaciones as $inv): ?>
            <tr>
                <td><?= htmlspecialchars($inv['email']) ?></td>
                <td><?= htmlspecialchars($inv['token']) ?></td>
                <td>
                    <input type="text" readonly
                           value="https://tusitio.com/registro.php?token=<?= $inv['token'] ?>"
                           size="50">
                </td>
                <td><?= $inv['used'] ? "✅ Usado" : "⏳ Pendiente" ?></td>
                <td><input type="checkbox" name="enviar[]" value="<?= $inv['id'] ?>"></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">No hay invitaciones pendientes</td></tr>
    <?php endif; ?>
</table>

<button type="submit">Enviar seleccionados</button>
