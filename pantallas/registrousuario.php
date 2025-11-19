<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: registro.html');
    exit;
}

$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$correo = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$pass_raw = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

if ($nombre === '' || $correo === '' || $telefono === '' || $pass_raw === '') {
    echo "<script>alert('Completa todos los campos.'); window.location.href='registro.html';</script>";
    exit;
}

// Verificar si ya existe el email usando prepared statement
$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM usuarios WHERE correo = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    echo "Error del servidor. Intenta más tarde.";
    exit;
}
$stmt->bind_param("s", $correo);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();

if ($row && intval($row['cnt']) > 0) {
    echo "<script>alert('El correo ya está registrado'); window.location.href='registro.html';</script>";
    exit;
}

// Insertar nuevo usuario (usa columna `contraseña` si existe en tu tabla)
$hash = password_hash($pass_raw, PASSWORD_DEFAULT);
$insert = $conn->prepare("INSERT INTO usuarios (nombre, correo, telefono, `contraseña`) VALUES (?, ?, ?, ?)");
if (!$insert) {
    error_log("Prepare insert failed: " . $conn->error);
    echo "Error del servidor al registrar. Intenta más tarde.";
    exit;
}
$insert->bind_param("ssss", $nombre, $correo, $telefono, $hash);
if ($insert->execute()) {
    $insert->close();
    echo "<script>alert('Registro exitoso'); window.location.href='iniciosesion.html';</script>";
    exit;
} else {
    error_log("Execute insert failed: " . $insert->error);
    echo "Error al registrar: " . htmlspecialchars($insert->error);
    $insert->close();
    exit;
}
?>