<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="EstadisticaSS.css">
    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
</head>
<body class="bg-secondary">
    
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="IMG/encabezado.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100">
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
                            <a class="nav-link" href="Ticket.php">Tickets</a>
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
            <div class="col-lg-9">
                <div class="card shadow">
                    <div class="card-header custom-card-header text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Estadísticas por Usuario</h4>
                        <button id="btnExportarExcel" class="btn btn-success">
                            <i class="bi bi-file-excel"></i> Descargar Excel
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Formulario de filtro por fechas y tipo de soporte -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="fechaInicio" class="form-label">Fecha de inicio:</label>
                                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
                            </div>
                            <div class="col-md-3">
                                <label for="fechaFin" class="form-label">Fecha de fin:</label>
                                <input type="date" class="form-control" id="fechaFin" name="fechaFin">
                            </div>
                            <div class="col-md-3">
                                <label for="tipoSoporte" class="form-label">Tipo de soporte:</label>
                                <select class="form-select" id="tipoSoporte" name="tipoSoporte">
                                    <option value="todos">Todos los tipos</option>
                                    <option value="Hoja grande">Hoja grande</option>
                                    <option value="Hoja chica">Hoja chica</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button id="btnFiltrar" class="btn btn-primary w-100">Filtrar</button>
                            </div>
                        </div>
                        
                        <div id="piechart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    
    <script type="text/javascript">
    // Variable global para almacenar los datos actuales
    let currentData = [];
    
    // Cargar Google Charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(function() {
        // Obtener la fecha actual
        const hoy = new Date();
        // Establecer fecha fin como hoy
        document.getElementById('fechaFin').valueAsDate = hoy;
        
        // Establecer fecha inicio como hace 1 mes
        const haceUnMes = new Date();
        haceUnMes.setMonth(hoy.getMonth() - 1);
        document.getElementById('fechaInicio').valueAsDate = haceUnMes;
        
        // Dibujar gráfico con datos iniciales
        drawChart(haceUnMes, hoy, 'todos');
    });

    // Función para dibujar el gráfico
    function drawChart(fechaInicio, fechaFin, tipoSoporte) {
        // Mostrar mensaje de carga
        document.getElementById('piechart').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><p class="mt-2">Cargando datos...</p></div>';
        
        // Simular una llamada AJAX con setTimeout
        setTimeout(function() {
            // Datos de ejemplo 
            let datosEjemplo = [
                ['Usuario', 'Soportes solicitados'],
                ['Juan',     11],
                ['Maria',    2],
                ['Pedro',    2],
                ['Ana',      2],
                ['Luis',     7],
                ['Carlos',   5],
                ['Laura',    3],
                ['Javier',   4],
                ['Sofia',    6],
                ['Diego',    1],
                ['Valeria',  8],
                ['Fernando', 9],
                ['Gabriela', 10]
            ];

            // Simular filtrado por tipo de soporte
            if (tipoSoporte !== 'todos') {
                // En una implementación real, esto se haría en el servidor
                // Aquí solo simulamos que algunos usuarios tienen más de un tipo
                datosEjemplo = datosEjemplo.map(row => {
                    if (row[0] === 'Usuario') return row;
                    // Simular que algunos usuarios tienen más solicitudes de un tipo que de otro
                    const factor = tipoSoporte === 'Hoja grande' ? 0.7 : 0.3;
                    return [row[0], Math.round(row[1] * factor)];
                });
            }

            currentData = datosEjemplo;

            var data = google.visualization.arrayToDataTable(currentData);

            // Crear título dinámico
            let titulo = 'Solicitudes de soporte por usuario (' + formatDate(fechaInicio) + ' a ' + formatDate(fechaFin) + ')';
            if (tipoSoporte !== 'todos') {
                titulo += ' - Tipo: ' + tipoSoporte;
            }

            var options = {
                title: titulo,
                is3D: true,
                pieSliceText: 'value',
                legend: {position: 'labeled'}
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }, 800); // Simulamos un retraso de red
    }

    // Función para formatear fecha como dd/mm/aaaa
    function formatDate(date) {
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    // Manejar el evento de clic en el botón Filtrar
    document.getElementById('btnFiltrar').addEventListener('click', function() {
        const fechaInicio = new Date(document.getElementById('fechaInicio').value);
        const fechaFin = new Date(document.getElementById('fechaFin').value);
        const tipoSoporte = document.getElementById('tipoSoporte').value;
        
        // Validar fechas
        if (isNaN(fechaInicio.getTime())) {
            alert('Por favor seleccione una fecha de inicio válida');
            return;
        }
        
        if (isNaN(fechaFin.getTime())) {
            alert('Por favor seleccione una fecha de fin válida');
            return;
        }
        
        if (fechaInicio > fechaFin) {
            alert('La fecha de inicio no puede ser posterior a la fecha de fin');
            return;
        }
        
        // Dibujar el gráfico con los nuevos filtros
        drawChart(fechaInicio, fechaFin, tipoSoporte);
    });

    // Función para exportar a Excel
    document.getElementById('btnExportarExcel').addEventListener('click', function() {
        if (currentData.length === 0) {
            alert('No hay datos para exportar');
            return;
        }
        
        // Crear un libro de trabajo de Excel
        const wb = XLSX.utils.book_new();
        
        // Convertir nuestros datos a una hoja de trabajo
        const ws = XLSX.utils.aoa_to_sheet(currentData);
        
        // Agregar la hoja de trabajo al libro
        XLSX.utils.book_append_sheet(wb, ws, "EstadisticasUsuarios");
        
        // Generar el archivo Excel y descargarlo
        const fecha = new Date();
        const nombreArchivo = `Estadisticas_Usuarios_${fecha.getFullYear()}${(fecha.getMonth()+1).toString().padStart(2, '0')}${fecha.getDate().toString().padStart(2, '0')}.xlsx`;
        
        XLSX.writeFile(wb, nombreArchivo);
    });
    </script>
</body>
</html>