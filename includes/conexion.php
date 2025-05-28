<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$db = '';

$conn =new mysqli($dbHost, $dbUser, $dbPass, $db);

if ($conn -> connect_error) {
    die("Error de conexion: " . $conn-> connect_error);
}
?>