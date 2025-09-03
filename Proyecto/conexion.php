<?php
$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "proyecto_cem";

$conn = new mysqli($host, $usuario, $contraseña, $base_de_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
