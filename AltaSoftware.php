
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="AltaSoftware.css">

</head>
<body class="bg-secondary">
    
    <div class="container-fluid g-0 mb-3"> <!-- container-fluid sin gutters (g-0) -->
        <div class="row">
            <div class="col-12 p-0"> <!-- columna sin padding (p-0) -->
                <img src="/SGT-Boostrap/imagenes/encabezadoHD.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100"> <!-- w-100 = width 100% -->
            </div>
        </div>

    <!-- Navigation -->
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
                            <li><a class="dropdown-item" href="/SGT-Boostrap/AltaSoftware.php">Alta Software</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Consultas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/SGT-Boostrap/ConsultaUsuarios.php">Usuario</a></li>
                            <li><a class="dropdown-item" href="/SGT-Boostrap/Consultas.php">Equipos</a></li>
                            <li><a class="dropdown-item" href="/SGT-Boostrap/ConsultaSoftware.php">Software</a></li>
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
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header custom-card-header text-white">
                        <h4 class="mb-0">Alta de Software</h4>
                    </div>
                    <div class="solicitud-container">
        <div class="form-header">
            <i class="bi bi-pc-display-horizontal"></i>
            <p class="text-muted">Complete todos los campos para registrar su solicitud</p>
        </div>
        
        <div class="solicitud">
            <form id="soporteForm" method="POST">
                <div class="row g-3 mb-4">
                        <div class="mb-3">
                            <label for="solicitante" class="form-label">Nombre Solicitante</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="solicitante" 
                                name="solicitante" 
                                value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?>" 
                                readonly
                            >
                        </div>
                        
                        <div class="mb-3">
                            <label for="marca" class="form-label required-field">Software a instalar</label>
                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Ingrese nombre del software" required>
                            <div class="form-text">Este campo es obligatorio</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mod" class="form-label">Versión del software</label>
                            <input type="text" class="form-control" id="mod" name="mod" placeholder="Ingrese versión del software">
                        </div>
                    
                        
                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo de instalación</label>
                        <textarea class="form-control" id="motivo" name="motivo" rows="3" placeholder="Describa detalladamente el motivo de instalación"></textarea>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg btn-submit">
                        <i class="bi bi-send-check me-2"></i>Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
