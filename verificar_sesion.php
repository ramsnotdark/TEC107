<?php
session_start();

// Tiempo de expiración en segundos (1 minuto)
$tiempo_expiracion = 300;

if (isset($_SESSION['LAST_ACTIVITY'])) {
    $inactividad = time() - $_SESSION['LAST_ACTIVITY'];
    if ($inactividad > $tiempo_expiracion) {
        session_unset();
        session_destroy();
        header("Location: login.php?mensaje=Sesión expirada, por favor inicia sesión nuevamente.");
        exit;
    }
}

// Actualiza la hora de última actividad
$_SESSION['LAST_ACTIVITY'] = time();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php?mensaje=Debes iniciar sesión.");
    exit;
}
?>
