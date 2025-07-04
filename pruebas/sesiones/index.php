<?php
session_start();
$_SESSION["nombre"]="Guio";
echo $_SESSION["nombre"];
echo "<br>";
print_r($_SESSION);