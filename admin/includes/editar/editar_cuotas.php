<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/controllers/controllerFee.php';
$idCuota = (int) $_GET['id'];
$controlador = new ControllerFee();
$cuota = $controlador->obtenerCuota($idCuota);
?>
<div>
    <h2>Editar cuotas</h2>
    <small class="aviso">Recuerda escribir el nombre y el precio, de lo contrario se guardarán como vacío</small>
    <?php if ($idCuota === 1): ?>
        <small class="aviso">Recuerda que esta cuota es la que se asigna por defecto</small>
    <?php endif; ?>
    <hr>
</div>

<form action="../../../MVC/core/router.php" method="POST">
    <input type="hidden" name="fee_id" value="<?= $idCuota ?>">
    <div class="campo">
        <label for="name">Nombre de la cuota</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($cuota->name) ?>">
    </div>
    <div class="campo">
        <label for="amount">Precio de la cuota</label>
        <input type="number" id="amount" name="amount" step="0.01" value="<?= htmlspecialchars($cuota->amount) ?>">
    </div>
    <div class="campo">
        <input type="submit" value="Guardar" name="editarCuota">
        <input type="reset" value="Resetear">
    </div>
</form>
