<?php
include "conexion.php";
header('Content-type: application/json; charset=utf-8');
$sql = "SELECT * FROM canchas";
$result = $conn->query($sql);

$datos = array();

while ($fila = $result->fetch_assoc()) {
    $datos[] = $fila;
}

echo json_encode($datos);
?>