<?php
include('conexion.php');

$sql = "SELECT * FROM reservas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>📋 Lista de Reservas</h2>";
    echo "<table border='1' cellpadding='5'>
            <tr><th>ID</th><th>Fecha</th><th>Hora</th><th>Estado</th></tr>";
    while($fila = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$fila["ID_reserva"]."</td>
                <td>".$fila["Fecha"]."</td>
                <td>".$fila["Hora"]."</td>
                <td>".$fila["Estado"]."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay reservas registradas.";
}

$conn->close();
?>
