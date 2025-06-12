<?php

require __DIR__ ."/includes/funciones.php";

session_start(); if(!isset($_SESSION)){
    session_start();
}

$auth = $_SESSION['login'] ?? false;

dispotkt();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Soporte</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.min.css">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="/SGT-Boostrap/css/SoporteUsuario.css">
</head>
<body>
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="/SGT-Boostrap/imagenes/encabezadoHD.jpg" alt="SOPORTEC" class="w-100">
            </div>
        </div>

    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/SGT-Boostrap/includes/cerrarsesion.php">Cerrar Sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4">Solicitud de Soporte</h2>
                    <form id="soporteForm" method="POST">
                        <div class="mb-3">
                            <label for="inventario" class="form-label">No. Inventario:</label>
                            <input type="text" class="form-control" id="inventario" name="inventario">
                        </div>
                        
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca:</label>
                            <input type="text" class="form-control" id="marca" name="marca">
                        </div>
                        
                        <div class="mb-3">
                            <label for="mod" class="form-label">Modelo:</label>
                            <input type="text" class="form-control" id="mod" name="mod">
                        </div>
                        
                        <div class="mb-3">
                            <label for="serie" class="form-label">No. Serie:</label>
                            <input type="text" class="form-control" id="serie" name="serie">
                        </div>
                        <div class="mb-3">
                            <label for="serie" class="form-label">Cubiculo:</label>
                            <input type="text" class="form-control" id="cubi" name="cubi">
                        </div>
                        
                        <div class="mb-3">
                            <label for="motivo" class="form-label">Descripción del problema:</label>
                            <textarea class="form-control" id="motivo" name="motivo" rows="4" placeholder="Indique el problema en este campo" required></textarea>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>
    <script src="/SGT-Boostrap/js/global.js"></script>
</body>
</html>