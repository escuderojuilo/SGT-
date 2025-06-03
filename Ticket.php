<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tickets</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="/SGT-Boostrap/css/Ticket.css">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-secondary">
    
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="/SGT-Boostrap/imagenes/encabezadoHD.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100">
            </div>
        </div>

        <nav class="navbar navbar-expand-lg custom-navbar mb-4">
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
                            <li><a class="dropdown-item" href="/SGT-Boostrap/AltaInventario.php">Alta Inventario</a></li>
                            <li><a class="dropdown-item" href="/SGT-Boostrap/altaUsuario.php">Alta Usuario</a></li>
                            <li><a class="dropdown-item" href="/SGT-Boostrap/AltaSoportes.php">Alta Soportes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Consultas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/SGT-Boostrap/ConsultaUsuarios.php">Usuario</a></li>
                            <li><a class="dropdown-item" href="/SGT-Boostrap/Consultas.php">Equipos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SGT-Boostrap/Historial.php">Historial</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Soporte
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/SGT-Boostrap/soporteLab.php">Mantenimiento</a></li>
                            <li><a class="dropdown-item" href="/SGT-Boostrap/ticketAdmin.php">Soporte Tecnico</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Estadisticas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/SGT-Boostrap/EstadisticasSS.php">Estadisticas Servicio</a></li>
                            <li><a class="dropdown-item" href="/SGT-Boostrap/EstadisticasUsuario.php">Estadisticas Usuario</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SGT-Boostrap/Ticket.php">Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SGT-Boostrap/includes/cerrarsesion.php">Cerrar Sesion</a>
                    </li>
                </ul>
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
                                <button type="button" class="btn btn-danger" onclick="filtrarTickets('En espera')">
                                    <i class="material-icons">schedule</i> En Espera
                                </button>
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
                                        <th width="20%">Acciones</th>
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

    <!-- Modal para finalizar ticket -->
    <div class="modal fade" id="finalizarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Finalizar Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ticket ID: <span id="ticket-id-finalizar"></span></p>
                    <div class="mb-3">
                        <label for="fecha-finalizacion" class="form-label">Fecha de finalización:</label>
                        <input type="date" id="fecha-finalizacion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora-finalizacion" class="form-label">Hora de finalización:</label>
                        <input type="time" id="hora-finalizacion" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="finalizarTicket()">Finalizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para asignar servicio social -->
    <div class="modal fade" id="asignarModal" tabindex="-1" aria-labelledby="asignarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asignar servicio social al ticket <span id="ticket-id"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <label for="servicio-social-select" class="form-label">Selecciona un estudiante:</label>
                    <select id="servicio-social-select" class="form-select">
                        <option value="" selected disabled>Seleccione servicio social</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tipo-hoja" class="form-label">Tipo de hoja</label>
                        <select id="tipo-hoja" class="form-select">
                            <option value="" selected disabled>Seleccione tipo de hoja</option>
                            <option value="Hojachica">Hoja chica</option>
                            <option value="Hojagrande">Hoja grande</option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="asignarServicioSocial()">Asignar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script personalizado -->
    <script>
        // Variables globales para el tipo de usuario
        //const isAdmin = <?php //echo $_SESSION['user_type'] === 'admin' ? 'true' : 'false'; ?>;
       // const currentServiceSocial = '<?php //echo $_SESSION['service_social_name'] ?? ''; ?>';
    </script>
    <script src="ScriptTicket.js"></script>
</body>
</html>
</html>
