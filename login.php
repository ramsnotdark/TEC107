<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <!------ Include the above in your HEAD tag ---------->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>

<body>
    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
    <div class="alert alert-danger alert-dismissible text-center" id="error-alert" role="alert" style="margin: 10px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error:</strong> Usuario o contraseña incorrectos.
    </div>
    <?php endif; ?>

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Iniciar
                Sesion</label>
            <input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">Olvide la
                Contraseña</label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <form method="POST" action="verificar.php">
                        <div class="group">
                            <label for="user-login" class="label">Usuario o e-mail</label>
                            <input name="usuario" id="user-login" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Contraseña:</label>
                            <input name="password" id="pass" type="password" class="input" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Iniciar Sesion">
                        </div>
                    </form>
                    <div class="hr"></div>
                </div>

                <div class="for-pwd-htm">
                    <form action="recuperar.php" method="POST">
                        <div class="group">
                            <label for="user-reset" class="label">Usuario o e-mail</label>
                            <input id="user-reset" name="usuario" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="new-password" class="label">Nueva Contraseña</label>
                            <input id="new-password" name="nueva_clave" type="password" class="input" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Restablecer Contraseña">
                        </div>
                    </form>
                    <div class="hr"></div>
                </div>

                <div class="hr"></div>
            </div>
        </div>
    </div>
    </div>
    <!--NO SE OCUPARA EN ESTE CASO YA QUE ESTAMOS TRABAJANDO CON BOOTSTRAP 4.0.0-->
    <!-- Optional JavaScript -->
    <script>
    $(document).ready(function() {
        // Oculta la alerta después de 4 segundos
        setTimeout(function() {
            $("#error-alert").fadeOut("slow");
        }, 4000);
    });
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
</body>

</html>