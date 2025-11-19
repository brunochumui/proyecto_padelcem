<?php
header("Content-Type: application/json");

// Conexión a MySQL
$conn = new mysqli("localhost", "root", "", "padel"); // <--- CAMBIÁ TU BASE

if ($conn->connect_error) {
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

// Recibir JSON
$data = json_decode(file_get_contents("php://input"), true);

$cancha = $data["cancha"];
$inicio = $data["inicio"];
$fin = $data["fin"];
$tipo = $data["tipo"];
$precio = $data["precio"];

// Insert en BD
$sql = "INSERT INTO reservas (cancha, inicio, fin, tipo, precio)
        VALUES ('$cancha', '$inicio', '$fin', '$tipo', '$precio')";

if ($conn->query($sql)) {
    echo json_encode(["ok" => true]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>
