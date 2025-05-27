<?php
    require __DIR__ ."/includes/funciones.php";


    if(!isset($_SESSION)){
            session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    dispotkt();

    var_dump($_SESSION);

    //hola prueba de commit

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadisticas Usuario</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/SGT-Boostrap/css/AltaInventario.css"> 
</head>
<body>
    <!-- Header -->
    <div class="container-fluid g-0 mb-3"> <!-- container-fluid sin gutters (g-0) -->
        <div class="row">
            <div class="col-12 p-0"> <!-- columna sin padding (p-0) -->
                <img src="/SGT-Boostrap/imagenes/encabezado.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100"> <!-- w-100 = width 100% -->
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
                            <li><a class="dropdown-item" href="AltaInventario.php">Alta Inventario</a></li>
                            <li><a class="dropdown-item" href="altaUsuario.php">Alta Usuario</a></li>
                            <li><a class="dropdown-item" href="AltaSoportes.php">Alta Soportes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Consultas.php">Consultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Historial.php">Historial</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Soporte
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="soporteLab.php">Mantenimiento Laboratorio</a></li>
                            <li><a class="dropdown-item" href="ticketAdmin.php">Soporte Tecnico</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Estadisticas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="EstadisticasSS.php">Estadisticas Servicio</a></li>
                            <li><a class="dropdown-item" href="EstadisticasUsuario.php">Estadisticas Usuario</a></li>
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

    <!-- Form Container -->
    <div class="container form-container">
        <form method="post" class="row g-3">
            <div class="col-md-6">
                <label for="opcion" class="form-label">Elige una opción:</label>
                <select class="form-select" id="opcion" name="opcion" onchange="mostrarPreguntas()">
                    <option value="">--Selecciona--</option>
                    <option value="computadora">Computadora</option>
                    <option value="impresora">Impresora</option>
                    <option value="otro">Otro</option>
                </select>
            </div>

            <!-- Computadora Questions -->
            <div id="pregunta-computadora" class="pregunta-adicional row g-3">
                <div class="col-md-6">
                    <label for="tipo-computadora" class="form-label">Tipo de computadora:</label>
                    <select class="form-select" id="tipo-computadora" name="tipo-computadora">
                        <option value="Laptop">Laptop</option>
                        <option value="Escritorio">Escritorio</option>
                        <option value="All in One">All in One</option>
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label for="sistema-operativo" class="form-label">Sistema Operativo:</label>
                    <select class="form-select" id="sistema-operativo" name="sistemaop">
                        <option value="windows10">Windows 10</option>
                        <option value="windows11">Windows 11</option>
                        <option value="windows7">Windows 7</option>
                        <option value="linux-mint">Linux Mint</option>
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label for="procesador" class="form-label">Procesador:</label>
                    <input type="text" class="form-control" id="procesador" name="procesador">
                </div>
                
                <div class="col-md-6">
                    <label for="host" class="form-label">Host:</label>
                    <input type="text" class="form-control" id="host" name="host">
                </div>
                
                <div class="col-md-6">
                    <label for="ram" class="form-label">RAM:</label>
                    <input type="text" class="form-control" id="ram" name="ram">
                </div>
                
                <div class="col-md-6">
                    <label for="almacenamiento" class="form-label">Almacenamiento:</label>
                    <input type="text" class="form-control" id="almacenamiento" name="almacenamiento">
                </div>
            </div>

            <!-- Impresora Questions -->
            <div id="pregunta-impresora" class="pregunta-adicional">
                <div class="col-md-6">
                    <label for="tipo-impresora" class="form-label">Tipo de Impresora</label>
                    <select class="form-select" id="tipo-impresora" name="tipo-impresora">
                        <option value="Inyeccion">Inyeccion</option>
                        <option value="Tinta">Tinta</option>
                        <option value="Laser">Laser</option>
                        <option value="Tanque de Tinta">Tanque de Tinta</option>
                        <option value="Scaner">Scaner</option>
                    </select>
                </div>
            </div>

            <!-- Otro Questions -->
            <div id="pregunta-otro" class="pregunta-adicional">
                <div class="col-md-12">
                    <label for="descripcion-otro" class="form-label">Descripcion:</label>
                    <input type="text" class="form-control" id="descripcion-otro" name="descripcion-otro">
                </div>
            </div>
            
            <!-- Common Fields -->
            <div class="col-md-6">
                <label for="no_inventario" class="form-label">No. Inventario:</label>
                <input type="text" class="form-control" id="no_inventario" name="no_inventario">
            </div>
            
            <div class="col-md-6">
                <label for="no_serie" class="form-label">No Serie:</label>
                <input type="text" class="form-control" id="no_serie" name="no_serie">
            </div>
            
            <div class="col-md-6">
                <label for="marca" class="form-label">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>
            
            <div class="col-md-6">
                <label for="modelo" class="form-label">Modelo:</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            
            <div class="col-md-6">
                <label for="ip-alambrica" class="form-label">IP Alambrica:</label>
                <input type="text" class="form-control" id="ip-alambrica" name="ip-alambrica">
            </div>
            
            <div class="col-md-6">
                <label for="ip_inalambrica" class="form-label">IP Inalambrica:</label>
                <input type="text" class="form-control" id="ip_inalambrica" name="ip_inalambrica">
            </div>
            
            <div class="col-md-6">
                <label for="mac_alambrica" class="form-label">MAC Alambrica:</label>
                <input type="text" class="form-control" id="mac_alambrica" name="mac_alambrica">
            </div>
            
            <div class="col-md-6">
                <label for="mac_inalambrica" class="form-label">MAC inalambrica:</label>
                <input type="text" class="form-control" id="mac_inalambrica" name="mac_inalambrica">
            </div>
            
            <div class="col-12">
                <button type="submit" class="btn btn-custom">Dar de Alta</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
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
    </script>
</body>
</html>
