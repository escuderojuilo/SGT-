<?php
    require "includes/funciones.php";
    reg();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="/SGT-Boostrap/css/altaUsuariovv.css">
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
                        <h4 class="mb-0">Alta de usuario</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre: *</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pat" class="form-label">Apellido Paterno:</label>
                                        <input type="text" class="form-control" id="pat" name="pat" placeholder="Apellido Paterno" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mat" class="form-label">Apellido Materno:</label>
                                        <input type="text" class="form-control" id="mat" name="mat" placeholder="Apellido Materno">
                                    </div>
                                    <div class="mb-3">
                                        <label for="num" class="form-label">No. Trabajador/No. Cuenta:</label>
                                        <input type="text" class="form-control" id="num" name="num">
                                    </div>
                                    <div class="mb-3">
                                        <label for="depa" class="form-label">Departamento: *</label>
                                        <select class="form-select" id="depa" name="depa">
                                            <option value="1">Unidad de computo</option>
                                            <option value="2">Sanitaria y ambiental</option>
                                            <option value="3">Construcción</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pass" class="form-label">Contraseña:</label>
                                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cubiculo" class="form-label">Cubículo:</label>
                                        <input type="text" class="form-control" id="cubiculo" name="cubiculo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono:</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono">
                                    </div>
                                    <div class="mb-3">
                                        <label for="extension" class="form-label">Extensión:</label>
                                        <input type="text" class="form-control" id="extension" name="extension">
                                    </div>
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">Correo: *</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tipo_usuario" class="form-label">Tipo de usuario: *</label>
                                        <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                                            <option value="">Seleccione...</option>
                                            <option value="1">Administrador</option>
                                            <option value="3">Académico</option>
                                            <option value="2">Servicio Social</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                            <button type="submit" class="btn custom-btn-continuar btn-lg">Continuar</button>
                            </div>
                        </form>
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
