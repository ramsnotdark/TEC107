<?include 'verificar_sesion.php'?>
<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $nueva_clave = $_POST['nueva_clave'];

    $clave_hash = password_hash($nueva_clave, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET password=? WHERE usuario=? OR email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $clave_hash, $usuario, $usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Contraseña actualizada correctamente'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location.href='login.php';</script>";
    }
}
?>
