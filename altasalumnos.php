<?php include 'sesion.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <title>Altas Alumnos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!------ Include the above in your HEAD tag ---------->
    <!-- Bootstrap CSS -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="assets/js/menu.js"></script>
    <style>
    body {
        background: url('your-background.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.1);
        /* fondo transparente */
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
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">


    <!--ESTO NO SE UTILIZA POR QUE ESTAMOS UTILIZANDO BOOTSTRAP 4.0.0-->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
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
                <a class="navbar-brand" href="home.php">Brand</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="home.php">Home<span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                    <li><a href="calificaciones.php">Consulta de Alumnos y Calificaciones<span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
                    <li><a href="#">PENDIENTE<span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span
                                class="caret"></span><span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li><a href="alta.php">Alta de Usuarios</a></li>
                            <li><a href="#">PENDIENTE</a></li>
                            <li><a href="#">PENDIENTE</a></li>
                            <li class="divider"></li>
                            <li><a href="#">PENDIENTE</a></li>
                            <li class="divider"></li>
                            <li><a href="#">PENDIENTE</a></li>
                        </ul>
                    </li>
                    <li><a href="login.php">Cerrar Sesion<span style="font-size:16px;"
                                class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container">
        <form class="form-container">
            <h2 class="text-center">Registro de Alumnos y Calificaciones</h2>

            <!-- Información básica -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" placeholder="Apellidos">
            </div>

            <div class="form-group">
                <label for="grado">Grado:</label>
                <input type="text" class="form-control" id="grado" placeholder="Grado">
            </div>

            <div class="form-group">
                <label for="grupo">Grupo:</label>
                <input type="text" class="form-control" id="grupo" placeholder="Grupo">
            </div>

            <div class="form-group">
                <label for="materia">Materia:</label>
                <input type="text" class="form-control" id="materia" placeholder="Materia">
            </div>

            <!-- Calificaciones -->
            <h4 class="text-center">Calificaciones Trimestrales</h4>
            <div class="form-group">
                <label for="trim1">Calificación Trimestre 1:</label>
                <input type="number" class="form-control" id="trim1" placeholder="Trimestre 1"
                    oninput="calcularPromedio()">
            </div>

            <div class="form-group">
                <label for="trim2">Calificación Trimestre 2:</label>
                <input type="number" class="form-control" id="trim2" placeholder="Trimestre 2"
                    oninput="calcularPromedio()">
            </div>

            <div class="form-group">
                <label for="trim3">Calificación Trimestre 3:</label>
                <input type="number" class="form-control" id="trim3" placeholder="Trimestre 3"
                    oninput="calcularPromedio()">
            </div>

            <div class="form-group">
                <label for="promedio">Promedio:</label>
                <input type="text" class="form-control" id="promedio" placeholder="Promedio" readonly>
            </div>

            <!-- Botones -->
            <div class="text-center">
                <button type="submit" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-danger"
                    onclick="window.location.href='home.php';">Cancelar</button>
            </div>
        </form>
    </div>

    <script>
    function calcularPromedio() {
        var t1 = parseFloat(document.getElementById('trim1').value) || 0;
        var t2 = parseFloat(document.getElementById('trim2').value) || 0;
        var t3 = parseFloat(document.getElementById('trim3').value) || 0;
        var promedio = ((t1 + t2 + t3) / 3).toFixed(2);
        document.getElementById('promedio').value = promedio;
    }
    </script>

</body>


</html>