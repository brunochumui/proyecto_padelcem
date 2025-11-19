<?php
include('conexion.php');
$host = "localhost";
$user = "root";
$pass = "";
$db = "sistemas_canchas";

$conexion = new mysqli($host, $user, $pass, $db);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    $verificar = "SELECT * FROM usuarios WHERE correo='$correo'";
    $resultado = mysqli_query($conexion, $verificar);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<script>alert('El correo ya está registrado'); window.location.href='registro.html';</script>";
        exit;
    }
    $sql = "INSERT INTO usuarios (nombre, correo, telefono, contraseña) VALUES ('$nombre', '$correo', '$telefono', '$contraseña')";
    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Registro exitoso'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>