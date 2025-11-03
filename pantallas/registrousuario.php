<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['clave'];

    $sql = "INSERT INTO usuarios (Nombre, Correo, Telefono, C)
            VALUES ('$nombre', '$correo', '$telefono', '$contraseña')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Usuario registrado correctamente.";
    } else {
        echo "❌ Error: " . $conn->error;
    }

    $conn->close();
}
?>
