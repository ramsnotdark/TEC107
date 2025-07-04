<?php
include 'conexion.php';
include 'verificar_sesion.php';

// Filtros
$nombre = $_GET['nombre'] ?? '';
$apellidos = $_GET['apellidos'] ?? '';
$email = $_GET['email'] ?? '';
$usuario = $_GET['usuario'] ?? '';
$ver_inactivos = isset($_GET['mostrar_inactivos']) ? 1 : 0;

$param1 = "%$nombre%";
$param2 = "%$apellidos%";
$param3 = "%$email%";
$param4 = "%$usuario%";

// Consulta SQL según si se muestran activos o inactivos
$sql = "SELECT * FROM usuarios WHERE nombre LIKE ? AND apellidos LIKE ? AND email LIKE ? AND usuario LIKE ? AND activo = ?";
$stmt = $conn->prepare($sql);
$estado = $ver_inactivos ? 0 : 1; // 0 = inactivos, 1 = activos
$stmt->bind_param("ssssi", $param1, $param2, $param3, $param4, $estado);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CONSULTA DE USUARIOS</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">
    <style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        background-color: #ccc;
        border-radius: 24px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #5cb85c;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
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
                        <li><a href="alta.php">Alta de Usuarios <span
                                    class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
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
        <h2 class="text-center">CONSULTA DE USUARIOS</h2>

        <form method="GET" class="form-inline">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>">
            </div>
            <div class="form-group">
                <label>Apellidos:</label>
                <input type="text" name="apellidos" class="form-control" value="<?= htmlspecialchars($apellidos) ?>">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>">
            </div>
            <div class="form-group">
                <label>Usuario:</label>
                <input type="text" name="usuario" class="form-control" value="<?= htmlspecialchars($usuario) ?>">
            </div>
            <div class="form-group">
                <label style="margin-right: 10px;">Estado:</label>
                <label class="switch">
                    <input type="checkbox" name="mostrar_inactivos" value="1" <?= $ver_inactivos ? 'checked' : '' ?>
                        id="estadoToggle">
                    <span class="slider"></span>
                </label>
                <span id="estadoLabel"
                    style="margin-left: 10px; font-weight: bold; color: <?= $ver_inactivos ? 'red' : 'green' ?>;">
                    <?= $ver_inactivos ? 'Mostrando usuarios deshabilitados' : 'Mostrando usuarios activos' ?>
                </span>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Activar/Desactivar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['apellidos']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['usuario']) ?></td>
                    <td><?= $row['activo'] ? 'Activo' : 'Desactivado' ?></td>
                    <td>
                        <button class="btn btn-primary btn-xs" data-toggle="modal"
                            data-target="#editarModal<?= $row['id'] ?>">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                    </td>
                    <td>
                        <a href="toggle_estado.php?id=<?= $row['id'] ?>"
                            class="btn btn-<?= $row['activo'] ? 'danger' : 'success' ?> btn-xs">
                            <?= $row['activo'] ? 'Desactivar' : 'Activar' ?>
                        </a>
                    </td>
                </tr>

                <!-- Modal de edición -->
                <div class="modal fade" id="editarModal<?= $row['id'] ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="editar_usuario.php" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar Usuario</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" name="nombre"
                                            value="<?= htmlspecialchars($row['nombre']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Apellidos</label>
                                        <input type="text" class="form-control" name="apellidos"
                                            value="<?= htmlspecialchars($row['apellidos']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Usuario</label>
                                        <input type="text" class="form-control" name="usuario"
                                            value="<?= htmlspecialchars($row['usuario']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="<?= htmlspecialchars($row['email']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Contraseña (dejar vacío para no cambiar)</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('estadoToggle');
        const label = document.getElementById('estadoLabel');

        toggle.addEventListener('change', function() {
            if (this.checked) {
                label.textContent = 'Mostrando usuarios deshabilitados';
                label.style.color = 'red';
            } else {
                label.textContent = 'Mostrando usuarios activos';
                label.style.color = 'green';
            }
        });
    });
    </script>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>