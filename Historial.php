<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Tickets</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.min.css">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="Historial.css">
</head>
<body>
    <!-- Header -->
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="imagenes/encabezado.jpg" alt="SOPORTEC" class="w-100">
            </div>
        </div>
    

    <!-- Navigation -->
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
                            <li><a class="dropdown-item" href="AltaInventario.php">Alta Inventario</a></li>
                            <li><a class="dropdown-item" href="AltaUsuario.php">Alta Usuario</a></li>
                            <li><a class="dropdown-item" href="SoportesAntiguos.php">Alta Soportes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="consultas.html">Consultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Historial.html">Historial</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Estadisticas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="EstadisticasSS.html">Estadisticas Servicio</a></li>
                            <li><a class="dropdown-item" href="EstadisticasUsuario.html">Estadisticas Usuario</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Ticket.php">Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="includes/cerrarsesion.php">Cerrar Sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table id="datatable_tickets" class="table table-striped table-hover table-bordered w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Solicitante</th>
                            <th>Cubiculo</th>
                            <th>Horario</th>
                            <th>Problema</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Término</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                 </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Nuestros scripts -->
    <script src="Tickets.js"></script>
    <script src="HistorialMain.js"></script>
</body>
</html>