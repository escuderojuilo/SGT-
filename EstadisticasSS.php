<?php

require "SGT-Boostrap/includes/database.php";

$con ='SELECT usuario.NOMBRE, asignacion.ID_UC, COUNT(*) as veces FROM asignacion inner join personal_uc on asignacion.ID_UC = personal_uc.ID_UC
 inner join usuario on personal_uc.ID_USR = usuario.ID_USR group by ID_UC';



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
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="SGT-Boostrap/css/EstadisticaSS.css">
    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);


    function drawChart() {


        var resultados = <?php echo json_encode($resultados); ?>;

         var dataArray = [['Actividad', 'Veces']];
        resultados.forEach(function(fila) {
            dataArray.push([fila.NOMBRE, parseInt(fila.veces)]);
        });
        
        var data = google.visualization.arrayToDataTable(dataArray);
        // var data = google.visualization.arrayToDataTable([

        var options = {
            title: 'Actividades de los SS'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
    </script>
</head>
<body class="bg-secondary">
    
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="SGT-Boostrap/imagenes/encabezado.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100">
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
                                <li><a class="dropdown-item" href="SGT-Boostrap/AltaInventario.php">Alta Inventario</a></li>
                                <li><a class="dropdown-item" href="SGT-Boostrap/AltaUsuario.php">Alta Usuario</a></li>
                                <li><a class="dropdown-item" href="SGT-Boostrap/SoportesAntiguos.php">Alta Soportes</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="SGT-Boostrap/Consultas.php">Consultas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="SGT-Boostrap/Historial.php">Historial</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Estadísticas
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="SGT-Boostrap/EstadisticasSS.php">Estadísticas Servicio</a></li>
                                <li><a class="dropdown-item" href="SGT-Boostrap/EstadisticasUsuario.php">Estadísticas Usuario</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="SGT-Boostrap/Ticket.php">Tickets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="SGT-Boostrap/index.php">Cerrar Sesión</a>
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
                    <div class="card-header custom-card-header text-white">
                        <h4 class="mb-0">Estadísticas de Servicio</h4>
                    </div>
                    <div class="card-body">
                        <div id="piechart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>