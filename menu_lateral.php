<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú Lateral con Botón</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial;
      transition: padding-left 0.3s;
    }

    /* BOTÓN DE MENÚ FIJO */
    #toggle-btn {
      position: fixed;
      top: 10px;
      left: 10px;
      z-index: 1100;
      background-color: #2c3e50;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 3px;
      cursor: pointer;
    }

    /* SIDEBAR */
    #sidebar {
      width: 250px;
      background-color: #2c3e50;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      height: 100vh;
      overflow-y: auto;
      color: #ecf0f1;
      transition: left 0.3s ease;
      z-index: 1000;
    }

    #sidebar.closed {
      left: -250px;
    }

    #sidebar ul {
      list-style: none;
      padding: 0;
    }

    #sidebar ul li {
      padding: 12px 20px;
      border-bottom: 1px solid #34495e;
      cursor: pointer;
    }

    #sidebar ul li:hover,
    #sidebar ul li.active {
      background-color: #34495e;
    }

    #sidebar ul li i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }

    .submenu {
      display: none;
      background-color: #3c556e;
    }

    .submenu li {
      padding-left: 40px;
      font-size: 14px;
    }

    .submenu li i {
      margin-right: 8px;
    }

    /* CONTENIDO PRINCIPAL */
    .main-content {
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }

    #sidebar.closed ~ .main-content {
      margin-left: 0;
    }

  </style>
</head>
<body>

<!-- BOTÓN DE MENÚ -->
<button id="toggle-btn"><i class="fa fa-bars"></i></button>

<!-- MENÚ LATERAL -->
<div id="sidebar">
  <ul>
    <li class="menu-item"><i class="fa fa-home"></i>Inicio</li>

    <li class="menu-item has-submenu">
      <i class="fa fa-users"></i>Usuarios
      <ul class="submenu">
        <li><i class="fa fa-plus"></i> Agregar Usuario</li>
        <li><i class="fa fa-search"></i> Consulta Usuarios</li>
      </ul>
    </li>

    <li class="menu-item has-submenu">
      <i class="fa fa-book"></i>Calificaciones
      <ul class="submenu">
        <li><i class="fa fa-pencil"></i> Captura</li>
        <li><i class="fa fa-list"></i> Consulta</li>
      </ul>
    </li>

    <li class="menu-item"><i class="fa fa-sign-out"></i>Cerrar Sesión</li>
  </ul>
</div>

<!-- CONTENIDO PRINCIPAL -->
<div class="main-content">
  <h1>Contenido principal</h1>
  <p>El contenido comienza aquí y se desplaza si el menú está abierto o cerrado.</p>
</div>

<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
  $(document).ready(function () {
    // Botón de mostrar/ocultar menú
    $('#toggle-btn').click(function () {
      $('#sidebar').toggleClass('closed');
    });

    // Submenús desplegables
    $('.has-submenu').click(function (e) {
      e.stopPropagation();
      $('.submenu').not($(this).find('.submenu')).slideUp();
      $(this).find('.submenu').slideToggle();
    });

    // Resaltar ítem activo
    $('.menu-item').click(function () {
      $('.menu-item').removeClass('active');
      $(this).addClass('active');
    });
  });
</script>

</body>
</html>
