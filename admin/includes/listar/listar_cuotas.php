<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/controllers/controllerFee.php';

$controladorFee = new ControllerFee();
$cuotas = $controladorFee->listaCuotas();

if ($cuotas && count($cuotas) > 0) {
?>
<article>
    <table class="cuotas">
        <thead>
            <tr>
                <th>Nombre cuota</th>
                <th>Importe</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($cuotas as $cuota): ?>
    <tr>
        <td><?= $cuota->name ?></td>
        <td><?= $cuota->amount ?> €</td>
        <td>
            <?php if ($cuota->fee_id != 1): ?>
                <form action="../../MVC/core/router.php" method="POST">
                    <input type="hidden" name="fee_id" value="<?= $cuota->fee_id ?>">
                    <input type="submit" value="Borrar" name="borrarCuota"
                           onclick="return confirm('¿Seguro que quieres borrar este registro?')">
                </form>
            <?php else: ?>
                <em>No se puede borrar</em>
            <?php endif; ?>
        </td>
        <td>
            <a href="../pages/cuotas.php?action=editar&id=<?= $cuota->fee_id ?>">Editar</a>
        </td>
    </tr>
<?php endforeach; ?>

        </tbody>
    </table>
    <hr>

    <div class="crearCuota">
        <a href="../pages/cuotas.php?action=crear">Crear cuota</a>
    </div>
</article>
<?php 
} else {
    echo "<p>No hay cuotas registradas.</p>";
}
?>
