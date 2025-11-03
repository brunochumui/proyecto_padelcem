<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO reservas (Fecha, Hora, Estado)
            VALUES ('$fecha', '$hora', '$estado')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Reserva creada correctamente.";
    } else {
        echo "❌ Error al crear la reserva: " . $conn->error;
    }

    $conn->close();
}
?>
