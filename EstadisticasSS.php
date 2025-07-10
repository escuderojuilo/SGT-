<?php

require "includes/database.php";

$con ='SELECT usuario.NOMBRE, asignacion.ID_USR, COUNT(*) as veces FROM asignacion
inner join usuario on asignacion.ID_USR = usuario.ID_USR group by ID_USR';

// Obtener los resultados
$resul = mysqli_query($db, $con);

foreach ($resul as $row) {
    $resultados[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas Servicio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Charts -->
    <link rel="stylesheet" href="/SGT-Boostrap/css/EstadisticaSS.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body class="bg-secondary">
    
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="/SGT-Boostrap/imagenes/encabezadoHD.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100">
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
            <div class="col-lg-9">
                <div class="card shadow">
                    <div class="card-header custom-card-header text-white">
                        <h4 class="mb-0">Estadísticas de Servicio</h4>
                    </div>
                    <div class="card-body">
                        <div id="piechart" style="width: 100%; height: 500px;"></div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn" style="background-color: #02A7DA; color: white" data-bs-toggle="modal" data-bs-target="#eliminarModal">
                            Eliminar Servicio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para eliminar servicios -->
    <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarModalLabel">Seleccionar servicios a eliminar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-checkbox-container">
                    <!-- Los checkboxes se generarán dinámicamente aquí -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="eliminarSeleccionados()">Eliminar seleccionados</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script type="text/javascript">
    
    // Cargar Google Charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    // Variable para almacenar la instancia del gráfico
    
    var resultados = <?php echo json_encode($resultados); ?>;

        var dataArray = [['Actividad', 'Veces']];
        resultados.forEach(function(fila) {
        dataArray.push([fila.NOMBRE, parseInt(fila.veces)]);
        });

    function drawChart() {

       // var resultados = <?php echo json_encode($resultados); ?>;

        //var dataArray = [['Actividad', 'Veces']];
       // resultados.forEach(function(fila) {
        //dataArray.push([fila.NOMBRE, parseInt(fila.veces)]);
        //});

        var data = google.visualization.arrayToDataTable(dataArray);
        // var data = google.visualization.arrayToDataTable([

        var options = {
            title: 'Actividades realizadas',
            is3D: true,
            pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        
        // Actualizar los checkboxes del modal
        actualizarCheckboxesModal();
    }
    
    // Función para actualizar los checkboxes en el modal
    function actualizarCheckboxesModal() {
        const container = document.getElementById('modal-checkbox-container');
        container.innerHTML = '';
        
        // Solo agregar checkboxes para los datos actuales (omitir encabezado)
        for (let i = 1; i < dataArray.length; i++) {
            const nombre = dataArray[i][0];
            const div = document.createElement('div');
            div.className = 'form-check modal-checkbox-item';
            div.innerHTML = `
                <input class="form-check-input" type="checkbox" value="${nombre}" id="modal-check-${nombre}">
                <label class="form-check-label" for="modal-check-${nombre}">
                    ${nombre} (${dataArray[i][1]} soportes)
                </label>
            `;
            container.appendChild(div);
        }
    }
    
    // Función para eliminar los elementos seleccionados
    function eliminarSeleccionados() {
        // Obtener todos los checkboxes marcados en el modal
        const checkboxes = document.querySelectorAll('#eliminarModal .form-check-input:checked');
        const nombresAEliminar = Array.from(checkboxes).map(cb => cb.value);
        
        if (nombresAEliminar.length === 0) {
            alert('Por favor selecciona al menos un servicio para eliminar');
            return;
        }
        
        // Filtrar los datos eliminando los seleccionados
        const nuevosDatos = [dataArray[0]]; // Mantener los encabezados
        for (let i = 1; i < dataArray.length; i++) {
            if (!nombresAEliminar.includes(dataArray[i][0])) {
                nuevosDatos.push(dataArray[i]);
            }
        }
        
        // Actualizar los datos y redibujar el gráfico
        dataArray = nuevosDatos;
        drawChart();
        
        // Cerrar el modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('eliminarModal'));
        modal.hide();
    }
    </script>
</body>
