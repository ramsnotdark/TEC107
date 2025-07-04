<?php
$host = "localhost";
$usuario = "root"; // usuario por defecto en XAMPP
$contrasena = ""; // contraseña vacía por defecto
$base_datos = "tec107"; // cambia si usaste otro nombre

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
