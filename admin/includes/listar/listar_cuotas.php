<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MVC/controllers/controllerFee.php';

$controladorFee = new ControllerFee();
$cuotas = $controladorFee->listaCuotas();

if ($cuotas && count($cuotas) > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nombre</th>";
    echo "<th>Importe</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($cuotas as $cuota) {
        echo "<tr>";
        echo "<td>{$cuota->fee_id}</td>";
        echo "<td>{$cuota->name}</td>";
        echo "<td>{$cuota->amount} €</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No hay cuotas registradas.</p>";
}
?>
