<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Obtener el estado actual
    $query = "SELECT activo FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($estado_actual);
    $stmt->fetch();
    $stmt->close();

    // Alternar estado
    $nuevo_estado = $estado_actual ? 0 : 1;
    $stmt = $conn->prepare("UPDATE usuarios SET activo = ? WHERE id = ?");
    $stmt->bind_param("ii", $nuevo_estado, $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: consulta_usuarios.php");
exit();
?>