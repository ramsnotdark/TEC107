<?php include 'sesion.php'; ?>

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
    body {
        background: url('fondo.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .registro-form {
        background: rgba(255, 255, 255, 0.1);
        /* fondo transparente */
        padding: 30px;
        border-radius: 10px;
        margin-top: 60px;
        color: #fff;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid #ccc;
        color: #fff;
    }

    .form-control::placeholder {
        color: #ddd;
    }

    .btn-green {
        background-color: #5cb85c;
        color: white;
    }

    .btn-red {
        background-color: #d9534f;
        color: white;
    }
    </style>


    <!--ESTO NO SE UTILIZA POR QUE ESTAMOS UTILIZANDO BOOTSTRAP 4.0.0-->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- Bootstrap 3.2 CSS -->
    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">-->

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
                    <li><a href="altasalumnos.php">Registro de Alumnos<span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                    <li><a href="#">Profile<span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
                    <li><a href="#">Messages<span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Herramientas<span
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
        <div class="row">
            <div class="col-md-6 col-md-offset-3 registro-form">
                <h2 class="text-center">Registro de Usuario</h2>
                <form action="procesar_registro.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario"
                            placeholder="Nombre de usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo"
                            placeholder="Correo electrónico" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmar">Confirmar Contraseña:</label>
                        <input type="password" class="form-control" id="confirmar" name="confirmar"
                            placeholder="Confirmar contraseña" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-green">Registrar</button>
                        <a href="home.php" class="btn btn-red">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

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