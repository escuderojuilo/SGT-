<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="ConsultaUsuario.css">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-secondary">
    
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="imagenes/encabezado.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100">
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
                            <a class="nav-link active" href="Usuario.php">Usuarios</a>
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
                        <h4 class="mb-0">Gestión de Usuarios</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-4">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary" onclick="filtrarUsuarios('todos')">
                                    <i class="material-icons">people</i> Todos
                                </button>
                                <button type="button" class="btn btn-danger" onclick="filtrarUsuarios('admin')">
                                    <i class="material-icons">security</i> Administradores
                                </button>
                                <button type="button" class="btn btn-warning" onclick="filtrarUsuarios('service_social')">
                                    <i class="material-icons">school</i> Servicio Social
                                </button>
                                <button type="button" class="btn btn-success" onclick="filtrarUsuarios('academico')">
                                    <i class="material-icons">person</i> Académicos
                                </button>
                                <button type="button" class="btn btn-info" onclick="filtrarUsuarios('lab_encargado')">
                                    <i class="material-icons">computer</i> Encargados Lab
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="40%">Nombre</th>
                                        <th width="40%">Rol</th>
                                        <th width="20%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="usuarios-body">
                                    <!-- Los usuarios se cargarán aquí dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal para cambiar rol (actualizado) -->
    <div class="modal fade" id="cambiarRolModal" tabindex="-1" aria-labelledby="cambiarRolModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar rol de usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>Usuario: <span id="usuario-nombre"></span></p>
                    <input type="hidden" id="usuario-id">
                    
                    <div class="mb-3">
                        <label for="rol-select" class="form-label">Selecciona un nuevo rol:</label>
                        <select id="rol-select" class="form-select" onchange="toggleLaboratorioField()">
                            <option value="admin">Administrador</option>
                            <option value="service_social">Servicio Social</option>
                            <option value="academico">Académico</option>
                            <option value="lab_encargado">Encargado de Laboratorio</option>
                        </select>
                    </div>
                    
                    <div id="laboratorio-container" class="mb-3" style="display: none;">
                        <label for="laboratorio-select" class="form-label">Selecciona laboratorio:</label>
                        <select id="laboratorio-select" class="form-select">
                            <option value="1">Lab 1</option>
                            <option value="2">Lab 2</option>
                            <option value="3">Lab 3</option>
                            <option value="4">Lab 4</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="cambiarRol()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!--
    <script>
        // Variables globales para el tipo de usuario
        const isAdmin = <?php echo $_SESSION['user_type'] === 'admin' ? 'true' : 'false'; ?>;
    </script>
    -->
<script src="ScriptUsuario.js"></script>
</body>
</html>