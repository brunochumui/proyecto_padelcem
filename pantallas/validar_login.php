<?php
$usuario = $_POST['email'];
$contraseña = $_POST['password'];

if ($usuario == 'admin' && $contraseña == '1234') {
    echo "<h2>Bienvenido, admin!</h2>";
} else {
    echo "<h2>Usuario o contraseña incorrectos</h2>";
}
?>