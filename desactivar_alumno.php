<?php
include("conexion.php");

$id = $_POST['id'] ?? null;

if ($id !== null) {
    // Obtener el estado actual del alumno
    $result = mysqli_query($conn, "SELECT estado FROM alumnos WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $nuevo_estado = ($row['estado'] == 1) ? 0 : 1;
        $update = "UPDATE alumnos SET estado = $nuevo_estado WHERE id = $id";
        mysqli_query($conn, $update);
    }
}

header("Location: calificaciones.php");
exit();
?>