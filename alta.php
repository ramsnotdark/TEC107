<?php include 'verificar_sesion.php';
include 'conexion.php';
?>

<!doctype html>
<html lang="en">

<head>
    <title>Registro de Usuarios</title>
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
    <style>
    h2 {
        color: black;
    }

    label {
        color: black;
    }

    .form-container {
        margin-top: 30px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    </style>

    <!--ESTO NO SE UTILIZA POR QUE ESTAMOS UTILIZANDO BOOTSTRAP 4.0.0-->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- Bootstrap 3.2 CSS -->
    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">-->

</head>


<body>
    <div class="container-fluid">
        <div class="row">

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
                                <li><a href="consulta_usuarios.php">Consulta de Usuarios <span
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

            <div class="container form-container">
                <div class="row">
                    <div class="col-md-9 col-md-offset-3">
                        <h2 class="text-center">ALTAS DE USUARIO</h2>
                        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>¡USUARIO CREADO CON ÉXITO!</strong>
                        </div>
                        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'existe'): ?>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>Error:</strong> El nombre de usuario o el correo ya existen.
                        </div>
                        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'pass'): ?>
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>Advertencia:</strong> Las contraseñas no coinciden.
                        </div>
                        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'bd'): ?>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>Error:</strong> No se pudo registrar el usuario. Intenta nuevamente.
                        </div>
                        <?php endif; ?>

                        <form id="registroForm" method="POST" action="guardarusuario.php">
                            <div class="form-group">
                                <label for="nombre">NOMBRE:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required
                                    autocomplete="given-name">
                            </div>
                            <div class="form-group">
                                <label for="apellidos">APELLIDOS:</label>
                                <input type="text" id="apellidos" name="apellidos" class="form-control" required
                                    autocomplete="family-name">
                            </div>
                            <div class="form-group">
                                <label for="usuario">NOMBRE DE USUARIO:</label>
                                <input type="text" id="usuario" name="usuario" class="form-control" required
                                    autocomplete="username">
                            </div>
                            <div class="form-group">
                                <label for="email">CORREO ELECTRONICO:</label>
                                <input type="email" id="email" name="email" class="form-control" required
                                    autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="password">CONTRASEÑA:</label>
                                <input type="password" id="password" name="password" class="form-control" required
                                    autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label for="confirmar_password">CONFIRMAR CONTRASEÑA:</label>
                                <input type="password" id="confirmar_password" name="confirmar_password"
                                    class="form-control" required autocomplete="new-password">
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <button type="button" class="btn btn-default"
                                onclick="limpiarFormulario()">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
            function limpiarFormulario() {
                document.getElementById("registroForm").reset();
            }
            </script>

            <!-- Bootstrap 3.2 JS -->
            <!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->


            <!-- Optional JavaScript -->

            <!--NO SE OCUPARA EN ESTE CASO YA QUE ESTAMOS TRABAJANDO CON BOOTSTRAP 4.0.0-->
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
</body>

</htm>