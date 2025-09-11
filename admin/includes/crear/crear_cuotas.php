
<h2>Crear cuotas</h2>
<form action="../../../MVC/core/router.php" method="POST">
    <div class="campo">
        <label for="name">Nombre de la cuota</label>
        <input type="text" name="name" placeholder="Escribe el nombre de la cuota">
    </div>
    <div class="campo">
        <label for="amount">Precio de la cuota</label>
        <input type="number" name="amount" placeholder="Escribe el valor de la cuota">
    </div>
    <div class="campo">
        <input type="submit" value="Crear cuota" name="crearCuota">
        <input type="reset" value="Resetear">
    </div>
</form>