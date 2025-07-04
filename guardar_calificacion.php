<?php
include 'conexion.php';

// Verificar que se recibió un ID válido
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    die("ID inválido.");
}

$id = intval($_POST['id']);

// Sanitizar y asignar los datos recibidos
$nombre = trim($_POST['nombre']);
$apellidos = trim($_POST['apellidos']);
$grado = trim($_POST['grado']);
$grupo = trim($_POST['grupo']);
$materia = trim($_POST['materia']);
$trimestre1 = isset($_POST['trimestre1']) ? floatval($_POST['trimestre1']) : 0;
$trimestre2 = isset($_POST['trimestre2']) ? floatval($_POST['trimestre2']) : 0;
$trimestre3 = isset($_POST['trimestre3']) ? floatval($_POST['trimestre3']) : 0;

// Preparar la sentencia para actualizar el registro
$sql = "UPDATE alumnos SET nombre = ?, apellidos = ?, grado = ?, grupo = ?, materia = ?, trimestre1 = ?, trimestre2 = ?, trimestre3 = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssddi", $nombre, $apellidos, $grado, $grupo, $materia, $trimestre1, $trimestre2, $trimestre3, $id);

if ($stmt->execute()) {
    // Redirigir de nuevo a calificaciones.php
    header("Location: calificaciones.php");
    exit();
} else {
    echo "Error al guardar los datos: " . $stmt->error;
}
?>