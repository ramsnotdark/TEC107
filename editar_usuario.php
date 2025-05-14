<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, apellidos=?, usuario=?, email=?, password=? WHERE id=?");
        $stmt->bind_param("sssssi", $nombre, $apellidos, $usuario, $email, $hashed_password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, apellidos=?, usuario=?, email=? WHERE id=?");
        $stmt->bind_param("ssssi", $nombre, $apellidos, $usuario, $email, $id);
    }

    if ($stmt->execute()) {
        header("Location: consulta_usuarios.php?success=1");
    } else {
        header("Location: consulta_usuarios.php?error=1");
    }

    $stmt->close();
    $conn->close();
}
?>