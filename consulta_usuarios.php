<?php include 'sesion.php'; ?>
<?php
// consulta_usuarios.php
include 'conexion.php';

// Obtener filtro de estado (activos o desactivados)
$estado = isset($_POST['estado']) ? $_POST['estado'] : '1';

// Obtener filtros de búsqueda si existen
$filtro_nombre = isset($_POST['filtro_nombre']) ? $_POST['filtro_nombre'] : '';
$filtro_apellidos = isset($_POST['filtro_apellidos']) ? $_POST['filtro_apellidos'] : '';
$filtro_email = isset($_POST['filtro_email']) ? $_POST['filtro_email'] : '';
$filtro_usuario = isset($_POST['filtro_usuario']) ? $_POST['filtro_usuario'] : '';

// Consulta SQL con filtros
$sql = "SELECT * FROM usuarios WHERE estado = ?
        AND nombre LIKE ?
        AND apellidos LIKE ?
        AND email LIKE ?
        AND usuario LIKE ?";
$stmt = $conexion->prepare($sql);
$like_nombre = "%$filtro_nombre%";
$like_apellidos = "%$filtro_apellidos%";
$like_email = "%$filtro_email%";
$like_usuario = "%$filtro_usuario%";
$stmt->bind_param("sssss", $estado, $like_nombre, $like_apellidos, $like_email, $like_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Consulta de Usuarios</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!------ Include the above in your HEAD tag ---------->
    <!-- Bootstrap CSS -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="assets/js/menu.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">


    <!--ESTO NO SE UTILIZA POR QUE ESTAMOS UTILIZANDO BOOTSTRAP 4.0.0-->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>

<body>
    <nav class="navbar navbar-inverse sidebar" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-sidebar-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="home.php">Home<span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                    <li><a href="alta.php">Registro de Usuarios <span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
                    <li><a href="#">Messages<span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span
                                class="caret"></span><span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li><a href="alta.php">Alta de Usuarios</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php">Cerrar Sesión
                            <span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span>
                        </a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center">CONSULTA DE USUARIOS</h2>
        <form method="post" class="form-inline" style="margin-bottom: 15px;">
            <input type="text" name="filtro_nombre" placeholder="Nombre" value="<?= htmlspecialchars($filtro_nombre) ?>"
                class="form-control">
            <input type="text" name="filtro_apellidos" placeholder="Apellidos"
                value="<?= htmlspecialchars($filtro_apellidos) ?>" class="form-control">
            <input type="text" name="filtro_email" placeholder="Correo Electrónico"
                value="<?= htmlspecialchars($filtro_email) ?>" class="form-control">
            <input type="text" name="filtro_usuario" placeholder="Usuario"
                value="<?= htmlspecialchars($filtro_usuario) ?>" class="form-control">
            <label class="checkbox-inline">
                <input type="checkbox" name="estado" value="1" <?= $estado == '1' ? 'checked' : '' ?>> Activos
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="estado" value="0" <?= $estado == '0' ? 'checked' : '' ?>> Desactivados
            </label>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Activar/Desactivar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['nombre']) ?></td>
                    <td><?= htmlspecialchars($fila['apellidos']) ?></td>
                    <td><?= htmlspecialchars($fila['usuario']) ?></td>
                    <td><?= htmlspecialchars($fila['email']) ?></td>
                    <td><?= $fila['estado'] == 1 ? 'Activo' : 'Desactivado' ?></td>
                    <td>
                        <a href="editar_usuario.php?id=<?= $fila['id'] ?>" class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-pencil"></span> Editar
                        </a>
                    </td>
                    <td>
                        <a href="toggle_estado.php?id=<?= $fila['id'] ?>"
                            class="btn btn-<?= $fila['estado'] == 1 ? 'danger' : 'success' ?> btn-xs">
                            <span class="glyphicon glyphicon-<?= $fila['estado'] == 1 ? 'remove' : 'ok' ?>"></span>
                            <?= $fila['estado'] == 1 ? 'Desactivar' : 'Activar' ?>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


    <!-- Optional JavaScript -->


    <!--NO SE OCUPARA EN ESTE CASO YA QUE ESTAMOS TRABAJANDO CON BOOTSTRAP 4.0.0-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
</body>

</html>