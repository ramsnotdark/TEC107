<?php
include 'conexion.php';
include 'verificar_sesion.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $grado = trim($_POST['grado']);
    $grupo = trim($_POST['grupo']);
    $materia = trim($_POST['materia']);

    $stmt = $conn->prepare("INSERT INTO alumnos (nombre, apellidos, grado, grupo, materia) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $apellidos, $grado, $grupo, $materia);

    if ($stmt->execute()) {
        $mensaje = "ALUMNO REGISTRADO CON ÉXITO";
    } else {
        $mensaje = "Error al registrar alumno: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="es">

<head>
    <title>Altas Alumnos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap y scripts -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="assets/js/menu.js"></script>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">

    <style>
    body {
        background: url('your-background.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 10px;
        color: black;
        max-width: 600px;
        margin: 50px auto;
    }

    label {
        color: black;
    }

    .form-group input {
        background-color: rgba(255, 255, 255, 0.8);
    }
    </style>
</head>

<body>
    <!-- Menú lateral -->
    <div class="col-sm-3 col-md-2">
        <nav class="navbar navbar-inverse sidebar" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-sidebar-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php">Menú</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="calificaciones.php">Consulta de Alumnos <span
                                    class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a>
                        </li>
                        <li><a href="logout.php">Cerrar Sesión <span
                                    class="pull-right hidden-xs showopacity glyphicon glyphicon-log-out"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <form class="form-container" method="POST" action="" id="form-alumno">
            <h2 class="text-center">Registro de Alumnos</h2>

            <?php if ($mensaje != ""): ?>
            <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required>
            </div>

            <div class="form-group">
                <label for="grado">Grado:</label>
                <input type="text" class="form-control" name="grado" placeholder="Grado" required>
            </div>

            <div class="form-group">
                <label for="grupo">Grupo:</label>
                <input type="text" class="form-control" name="grupo" placeholder="Grupo" required>
            </div>

            <div class="form-group">
                <label for="materia">Materia:</label>
                <input type="text" class="form-control" name="materia" placeholder="Materia" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-danger"
                    onclick="document.getElementById('form-alumno').reset();">Cancelar</button>
            </div>
        </form>
    </div>
</body>

</html>