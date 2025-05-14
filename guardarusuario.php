<?php
include 'conexion.php'; // Asegúrate que este archivo conecta a tu base de datos correctamente

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmar_password = $_POST['confirmar_password'];

// Verifica que las contraseñas coincidan
if ($password !== $confirmar_password) {
    header("Location: alta.php?error=pass");
    exit();
}

// Verifica si el usuario o el email ya existen
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ? OR email = ?");
$stmt->bind_param("ss", $usuario, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: alta.php?error=existe");
    exit();
}

// Encriptar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertar nuevo usuario
$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, usuario, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nombre, $apellidos, $usuario, $email, $hashed_password);

if ($stmt->execute()) {
    header("Location: alta.php?success=1");
    exit();
} else {
    header("Location: alta.php?error=bd");
    exit();
}
?>
