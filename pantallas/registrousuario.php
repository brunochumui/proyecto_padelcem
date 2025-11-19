<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    $verificar = "SELECT * FROM usuarios WHERE Correo='$correo'";
    $resultado = mysqli_query($conexion, $verificar);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<script>alert('El correo ya está registrado'); window.location.href='registro.html';</script>";
        exit;
    }
    $sql = "INSERT INTO usuarios (Nombre, Correo, Telefono, Clave) VALUES ('$nombre', '$correo', '$telefono', '$contraseña')";
    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Registro exitoso'); window.location.href='../index.html';</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>