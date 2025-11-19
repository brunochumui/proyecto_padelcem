<?php

session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: iniciosesion.html');
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($email === '' || $password === '') {
    echo "Completa email y contraseña. <a href='iniciosesion.html'>Volver</a>";
    exit;
}


$stmt = $conn->prepare("SELECT `ID_usuario`, `nombre`, `correo`, `contraseña` FROM usuarios WHERE correo = ? LIMIT 1");
if (!$stmt) {
    echo "Error en la consulta (prepare).";
    exit;
}
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hash = $row['contraseña']; // columna con la contraseña hasheada

    if (password_verify($password, $hash)) {
        // Inicio de sesión OK
        $_SESSION['user'] = [
            'id' => $row['ID_usuario'],
            'nombre' => $row['nombre'],
            'correo' => $row['correo']
        ];
        header('Location: index.html');
        exit;
    } else {
        echo "Contraseña incorrecta. <a href='iniciosesion.html'>Volver</a>";
        exit;
    }
} else {
    echo "Usuario no encontrado. <a href='registro.html'>Registrate</a>";
    exit;
}
?>