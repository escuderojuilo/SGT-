<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altas Soportes</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="css/AltaSoportes.css">
</head>
<body>
    <div class="container-fluid g-0">
        <div class="row">
            <div class="col-12 p-0">
                <img src="imagenes/encabezado.jpg" alt="SOPORTEC" class="w-100">
            </div>
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
                            <li><a class="dropdown-item" href="/SGT-Boostrap/soporteLab.php">Usuario</a></li>
                            <li><a class="dropdown-item" href="/SGT-Boostrap/ticketAdmin.php">Equipos</a></li>
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
                        <a class="nav-link" href="includes/cerrarsesion.php">Cerrar Sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="container main-content-container">
        <form class="bg-custom p-4 rounded">
            <!-- Datos Solicitante -->
            <fieldset class="mb-4">
                <legend class="px-2">Datos Solicitante</legend>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre_solicitante" class="form-label">Nombre del solicitante:</label>
                        <input type="text" class="form-control" id="nombre_solicitante" name="nombre_solicitante" required>
                    </div>
                    <div class="col-md-6">
                        <label for="opcion" class="form-label">Departamento:</label>
                        <select class="form-select" id="opcion" name="opcion" onchange="mostrarPreguntas()">
                            <option value="">--Selecciona--</option>
                            <option value="computadora">Computadora</option>
                            <option value="impresora">Impresora</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="edificio" class="form-label">Edificio:</label>
                        <input type="text" class="form-control" name="edificio" id="edificio" required>
                    </div>
                    <div class="col-md-4">
                        <label for="piso" class="form-label">Piso:</label>
                        <input type="text" class="form-control" name="piso" id="piso" required>
                    </div>
                    <div class="col-md-4">
                        <label for="cubiculo" class="form-label">Cubiculo:</label>
                        <input type="text" class="form-control" name="cubiculo" id="cubiculo" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Telefono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" required>
                    </div>
                    <div class="col-md-6">
                        <label for="extension" class="form-label">Extension:</label>
                        <input type="text" class="form-control" name="extension" id="extension" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="email" class="form-control" name="correo" id="correo" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                </div>
            </fieldset>

            <!-- Hardware -->
            <fieldset class="mb-4">
                <legend class="px-2">Hardware</legend>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="no_inventario" class="form-label">No. Inventario:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="no_inventario" name="no_inventario" required>
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Tipo de equipo:</label>
                        <div class="radio-options">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="pc" name="tipoEquipo" value="PC" onchange="mostrarCampoOtro()">
                                <label class="form-check-label" for="pc">PC de escritorio</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="laptop" name="tipoEquipo" value="Laptop" onchange="mostrarCampoOtro()">
                                <label class="form-check-label" for="laptop">Laptop/Notebook</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="tablet" name="tipoEquipo" value="Tablet" onchange="mostrarCampoOtro()">
                                <label class="form-check-label" for="tablet">Tablet</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="smartphone" name="tipoEquipo" value="Smartphone" onchange="mostrarCampoOtro()">
                                <label class="form-check-label" for="smartphone">Smartphone</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="otro" name="tipoEquipo" value="Otro" onchange="mostrarCampoOtro()">
                                <label class="form-check-label" for="otro">Otro (especificar)</label>
                            </div>
                        </div>
                        <div id="campo-otro" class="mt-2 hidden-field">
                            <input type="text" class="form-control" id="otroEspecificar" name="otroEspecificar" placeholder="¿Qué tipo de equipo?">
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="marca" class="form-label">Marca:</label>
                        <input type="text" class="form-control" id="marca" name="marca" required>
                    </div>
                    <div class="col-md-4">
                        <label for="modelo" class="form-label">Modelo:</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" required>
                    </div>
                    <div class="col-md-4">
                        <label for="no_serie" class="form-label">No Serie:</label>
                        <input type="text" class="form-control" id="no_serie" name="no_serie" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="sistema_operativo" class="form-label">Sistema Operativo:</label>
                        <input type="text" class="form-control" id="sistema_operativo" name="sistema_operativo" required>
                    </div>
                    <div class="col-md-3">
                        <label for="procesador" class="form-label">Procesador:</label>
                        <input type="text" class="form-control" id="procesador" name="procesador" required>
                    </div>
                    <div class="col-md-3">
                        <label for="hd" class="form-label">H.D.:</label>
                        <input type="text" class="form-control" id="hd" name="hd" required>
                    </div>
                    <div class="col-md-3">
                        <label for="ram" class="form-label">RAM:</label>
                        <input type="text" class="form-control" id="ram" name="ram" required>
                    </div>
                </div>
                
                <!-- Conexión Alámbrica -->
                <fieldset class="mb-3">
                    <legend class="px-2 fs-6">Conexión Alámbrica (Ethernet)</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ip-alambrica" class="form-label">Dirección IP Alámbrica:</label>
                            <input type="text" class="form-control" id="ip-alambrica" name="ip_alambrica" 
                                   pattern="^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$"
                                   placeholder="Ej. 192.168.1.100" required>
                        </div>
                        <div class="col-md-6">
                            <label for="mac-alambrica" class="form-label">Dirección MAC Alámbrica:</label>
                            <input type="text" class="form-control" id="mac-alambrica" name="mac_alambrica" 
                                   pattern="^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$"
                                   placeholder="Ej. 00:1A:2B:3C:4D:5E" required>
                        </div>
                    </div>
                </fieldset>
                
                <!-- Conexión Inalámbrica -->
                <fieldset>
                    <legend class="px-2 fs-6">Conexión Inalámbrica (Wi-Fi)</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ip-inalambrica" class="form-label">Dirección IP Inalámbrica:</label>
                            <input type="text" class="form-control" id="ip-inalambrica" name="ip_inalambrica" 
                                   pattern="^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$"
                                   placeholder="Ej. 192.168.1.101">
                        </div>
                        <div class="col-md-6">
                            <label for="mac-inalambrica" class="form-label">Dirección MAC Inalámbrica:</label>
                            <input type="text" class="form-control" id="mac-inalambrica" name="mac_inalambrica" 
                                   pattern="^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$"
                                   placeholder="Ej. 00:1A:2B:3C:4D:5F">
                        </div>
                    </div>
                </fieldset>
            </fieldset>
            
            <!-- Problema Reportado -->
            <fieldset class="mb-4">
                <legend class="px-2">Problema Reportado</legend>
                <textarea class="form-control" id="problema" name="problema" rows="4" required></textarea>
            </fieldset>
            
            <!-- Solución -->
            <fieldset class="mb-4">
                <legend class="px-2">Solución</legend>
                <textarea class="form-control" id="solucion" name="solucion" rows="4" required></textarea>
            </fieldset>
            
            <!-- Realizo -->
            <fieldset class="mb-4">
                <legend class="px-2">Realizo</legend>
                <input type="text" class="form-control" id="realizo" name="realizo" required>
            </fieldset>
            
            <!-- Submit Button -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function mostrarPreguntas() {
            // Ocultar todas las preguntas adicionales
            document.querySelectorAll('.pregunta-adicional').forEach(function(element) {
                element.style.display = 'none';
            });

            // Mostrar la pregunta adicional correspondiente a la opción seleccionada
            var opcion = document.getElementById('opcion').value;
            if (opcion) {
                document.getElementById('pregunta-' + opcion).style.display = 'block';
            }
        }

        function mostrarCampoOtro() {
            var campoOtro = document.getElementById('campo-otro');
            var radioOtro = document.getElementById('otro');
            
            if (radioOtro.checked) {
                campoOtro.classList.remove('hidden-field');
                document.getElementById('otroEspecificar').required = true;
            } else {
                campoOtro.classList.add('hidden-field');
                document.getElementById('otroEspecificar').required = false;
                document.getElementById('otroEspecificar').value = '';
            }
        }
    </script>
</body>
</html>
