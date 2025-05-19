<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadisticas Usuario</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="SGT-Boostrap/css/AltaInventario.css"> 
</head>
<body>
    <!-- Header -->
    <div class="container-fluid g-0 mb-3"> <!-- container-fluid sin gutters (g-0) -->
        <div class="row">
            <div class="col-12 p-0"> <!-- columna sin padding (p-0) -->
                <img src="SGT-Boostrap/imagenes/encabezado.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100"> <!-- w-100 = width 100% -->
            </div>
        </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Alta
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="SGT-Boostrap/AltaInventario.php">Alta Inventario</a></li>
                            <li><a class="dropdown-item" href="SGT-Boostrap/AltaUsuario.php">Alta Usuario</a></li>
                            <li><a class="dropdown-item" href="SGT-Boostrap/SoportesAntiguos.php">Alta Soportes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="SGT-Boostrap/Consultas.php">Consultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="SGT-Boostrap/Historial.php">Historial</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Estadisticas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="SGT-Boostrap/EstadisticasSS.php">Estadisticas Servicio</a></li>
                            <li><a class="dropdown-item" href="SGT-Boostrap/EstadisticasUsuario.php">Estadisticas Usuario</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="SGT-Boostrap/Ticket.php">Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="SGT-Boostrap/includes/cerrarsesion.php">Cerrar Sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>