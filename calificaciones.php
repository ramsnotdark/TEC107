<?php
include 'conexion.php';
include 'verificar_sesion.php';

$conn->set_charset("utf8");

$nombre = $_POST['filtro_nombre'] ?? '';
$apellidos = $_POST['filtro_apellidos'] ?? '';
$grado = $_POST['filtro_grado'] ?? '';
$grupo = $_POST['filtro_grupo'] ?? '';
$ver_inactivos = isset($_POST['filtro_inactivos']) ? 0 : 1;
$solo_aprobados = isset($_POST['filtro_aprobados']);
$solo_reprobados = isset($_POST['filtro_reprobados']);

$sql = "SELECT * FROM alumnos WHERE nombre LIKE ? AND apellidos LIKE ? AND grado LIKE ? AND grupo LIKE ? AND estado = ?";
$params = ["%$nombre%", "%$apellidos%", "%$grado%", "%$grupo%", $ver_inactivos];

if ($solo_aprobados) {
    $sql .= " AND ((trimestre1 + trimestre2 + trimestre3)/3) >= 6";
}
if ($solo_reprobados) {
    $sql .= " AND ((trimestre1 + trimestre2 + trimestre3)/3) < 6";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", ...$params);
$stmt->execute();
$resultado = $stmt->get_result();
$alumnos = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CALIFICACIONES</title>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="assets/js/menu.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="icon" href="https://res.cloudinary.com/dnt3e2a4s/image/upload/v1748981213/gnrfckc72ovvvwdelmjq.png"
        sizes="32x32">

    <style>
    .switch {
        display: inline-block;
        position: relative;
        width: 50px;
        height: 24px;
    }

    .switch input {
        display: none;
    }

    .slider {
        background-color: #ccc;
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        transition: .4s;
        border-radius: 24px;
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
        background-color: #2196F3;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .ancho-nombre {
        width: 200px;
    }

    .ancho-apellidos {
        width: 200px;
    }

    .ancho-materia {
        width: 115px;
    }

    .ancho-trimestre {
        width: 80px;
    }
    </style>
</head>

<body>
    
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
                        <li><a href="altasalumnos.php">Registro de Alumnos <span
                                    class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                        <li><a href="logout.php">Cerrar Sesión <span
                                    class="pull-right hidden-xs showopacity glyphicon glyphicon-log-out"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    

    <div class="container">
        <h2 class="text-center">CALIFICACIONES</h2>
        <form method="post">
            <div class="form-inline text-center">
                <label for="filtro_nombre">Nombre</label>
                <input type="text" id="filtro_nombre" name="filtro_nombre" class="form-control"
                    value="<?= htmlspecialchars($nombre) ?>" placeholder="Nombre">
                <label for="filtro_apellidos">Apellidos</label>
                <input type="text" id="filtro_apellidos" name="filtro_apellidos" class="form-control"
                    value="<?= htmlspecialchars($apellidos) ?>" placeholder="Apellidos">
                <label for="filtro_grado">Grado</label>
                <input type="text" id="filtro_grado" name="filtro_grado" class="form-control"
                    value="<?= htmlspecialchars($grado) ?>" placeholder="Grado">
                <label for="filtro_grupo">Grupo</label>
                <input type="text" id="filtro_grupo" name="filtro_grupo" class="form-control"
                    value="<?= htmlspecialchars($grupo) ?>" placeholder="Grupo">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>

            <div class="form-inline text-center" style="margin-top: 10px;">
                <label>Aprobados
                    <label class="switch">
                        <input type="checkbox" name="filtro_aprobados" <?= $solo_aprobados ? 'checked' : '' ?>>
                        <span class="slider"></span>
                    </label>
                </label>
                <label>Reprobados
                    <label class="switch">
                        <input type="checkbox" name="filtro_reprobados" <?= $solo_reprobados ? 'checked' : '' ?>>
                        <span class="slider"></span>
                    </label>
                </label>
                <label>Mostrar Inactivos
                    <label class="switch">
                        <input type="checkbox" name="filtro_inactivos" <?= !$ver_inactivos ? 'checked' : '' ?>>
                        <span class="slider"></span>
                    </label>
                </label>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Grado</th>
                    <th>Grupo</th>
                    <th>Materia</th>
                    <th>Trimestre 1</th>
                    <th>Trimestre 2</th>
                    <th>Trimestre 3</th>
                    <th>Promedio</th>
                    <th>Guardar</th>
                    <th>Editar</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $row): 
                    $promedio = round(($row['trimestre1'] + $row['trimestre2'] + $row['trimestre3']) / 3, 2);
                ?>
                <tr>
                    <form method="post" action="guardar_calificacion.php">
                        <td><input type="text" name="nombre" class="form-control ancho-nombre"
                                value="<?= $row['nombre'] ?>" readonly></td>
                        <td><input type="text" name="apellidos" class="form-control ancho-apellidos"
                                value="<?= $row['apellidos'] ?>" readonly></td>
                        <td><input type="text" name="grado" class="form-control" value="<?= $row['grado'] ?>" readonly>
                        </td>
                        <td><input type="text" name="grupo" class="form-control" value="<?= $row['grupo'] ?>" readonly>
                        </td>
                        <td><input type="text" name="materia" class="form-control ancho-materia"
                                value="<?= $row['materia'] ?>" readonly></td>
                        <td><input type="number" name="trimestre1" class="form-control ancho-trimestre"
                                value="<?= $row['trimestre1'] ?>"></td>
                        <td><input type="number" name="trimestre2" class="form-control ancho-trimestre"
                                value="<?= $row['trimestre2'] ?>"></td>
                        <td><input type="number" name="trimestre3" class="form-control ancho-trimestre"
                                value="<?= $row['trimestre3'] ?>"></td>
                        <td><?= $promedio ?></td>
                        <td>
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </td>
                    </form>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editarModal"
                            onclick='llenarModal(<?= json_encode($row) ?>)'>Editar</button>
                    </td>
                    <td>
                        <form method="post" action="desactivar_alumno.php">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn <?= $row['estado'] == 1 ? 'btn-danger' : 'btn-warning' ?>">
                                <?= $row['estado'] == 1 ? 'Desactivar' : 'Activar' ?>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="guardar_calificacion.php">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Alumno</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_editar" name="id">
                        <?php
                            $campos = ['nombre' => 'Nombre', 'apellidos' => 'Apellidos', 'grado' => 'Grado', 'grupo' => 'Grupo', 'materia' => 'Materia',
                                'trimestre1' => 'Trimestre 1', 'trimestre2' => 'Trimestre 2', 'trimestre3' => 'Trimestre 3'];
                            foreach ($campos as $campo => $etiqueta) {
                                echo "<div class='form-group'>";
                                echo "<label for='$campo'>$etiqueta</label>";
                                echo "<input type='text' class='form-control' id='$campo' name='$campo'>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function llenarModal(alumno) {
        document.getElementById("id_editar").value = alumno.id;
        document.getElementById("nombre").value = alumno.nombre;
        document.getElementById("apellidos").value = alumno.apellidos;
        document.getElementById("grado").value = alumno.grado;
        document.getElementById("grupo").value = alumno.grupo;
        document.getElementById("materia").value = alumno.materia;
        document.getElementById("trimestre1").value = alumno.trimestre1;
        document.getElementById("trimestre2").value = alumno.trimestre2;
        document.getElementById("trimestre3").value = alumno.trimestre3;
    }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>