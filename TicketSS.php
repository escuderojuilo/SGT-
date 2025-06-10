<?php
session_start();
$idServicioSocial = $_SESSION['id_servicio_social'] ?? 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tickets</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="Ticket.css">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-secondary">
    
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="IMG/encabezadoHD.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100">
            </div>
        </div>

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
                            <a class="nav-link" href="consultas.php">Consultas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Historial.php">Historial</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Estadísticas
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="EstadisticasSS.php">Estadísticas Servicio</a></li>
                                <li><a class="dropdown-item" href="EstadisticasUsuario.php">Estadísticas Usuario</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Ticket.php">Tickets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="InicioSesion.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header custom-card-header text-white">
                        <h4 class="mb-0">Gestión de Tickets</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-4">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-warning" onclick="filtrarTickets('Iniciado')">
                                    <i class="material-icons">play_arrow</i> Iniciados
                                </button>
                                <button type="button" class="btn btn-success" onclick="filtrarTickets('Finalizado')">
                                    <i class="material-icons">check_circle</i> Finalizados
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="20%">Solicitante</th>
                                        <th width="15%">Cubículo</th>
                                        <th width="15%">Horario de atención</th>
                                        <th width="30%">Problema</th>
                                        <th width="20%">Atendió</th>
                                    </tr>
                                </thead>
                                <tbody id="tickets-body">
                                    <!-- Los tickets se cargarán aquí dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Pasamos el ID del servicio social desde PHP a JavaScript
        const idServicioSocial = <?php echo $idServicioSocial; ?>;
    </script>
    <script src="ScriptSS.js"></script>
    <script src="/SGT-Boostrap/js/global.js"></script>

</body>
</html>