<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/controllers/controllerPayments.php';

$mesSeleccionado = $_GET['mes'] ?? date('n');
$anioActual = date('Y');

$meses = [
    1 => "Enero", 2 => "Febrero", 3 => "Marzo",
    4 => "Abril", 5 => "Mayo", 6 => "Junio",
    7 => "Julio", 8 => "Agosto", 9 => "Septiembre",
    10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
];

$controlador = new ControllerPayments();
$resultados = $controlador->obtenerNoPagosMes($mesSeleccionado, $anioActual);
?>

<form method="GET" action="">
    <input type="hidden" name="action" value="pagosnok">
    <label for="mes">Selecciona mes:</label>
    <select name="mes" id="mes" onchange="this.form.submit()">
        <?php foreach ($meses as $num => $nombre): ?>
            <option value="<?= $num ?>" <?= ($num == $mesSeleccionado) ? 'selected' : '' ?>>
                <?= $nombre ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if ($resultados): ?>
    <h2>Usuarios SIN pago en <?= $meses[$mesSeleccionado] . " " . $anioActual ?></h2>
    <table>
        <tr>
            <th>Alumno</th>
        </tr>
        <?php foreach ($resultados as $fila): ?>
            <tr>
                <td><?= htmlspecialchars($fila['subname'] . ", " . $fila['name']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Todos los usuarios han pagado en este mes</p>
<?php endif; ?>
