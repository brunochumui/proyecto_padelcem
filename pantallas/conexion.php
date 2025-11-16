<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sistema_canchas";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    // Conexión exitosa: no imprimir nada aquí para evitar ensuciar
    // las respuestas JSON de las APIs (api.php, etc.).
}
?>
