<?php
    require __DIR__ ."/includes/funciones.php";

    verificarcuenta();

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Registro Exitoso!</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="RegistroExitoso.css" rel="stylesheet">
</head>
<body>
    <!-- Encabezado que ocupa todo el ancho con Bootstrap -->
    <div class="container-fluid g-0 mb-3"> <!-- container-fluid sin gutters (g-0) -->
        <div class="row">
            <div class="col-12 p-0"> <!-- columna sin padding (p-0) -->
                <img src="imagenes/encabezado.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100"> <!-- w-100 = width 100% -->
            </div>
        </div>
    </div>

    <!-- Contenido principal centrado verticalmente -->
    <div class="main-content">
        <div class="container mt-2">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h1 class="card-title mb-4">¡Registro Exitoso!</h1>
                            <p class="mb-4">Tu registro se ha completado correctamente.</p>
                            <div class="d-grid">
                                <!-- Botón que redirige a index.php -->
                                <a href="/SGT-Boostrap/index.php" class="btn btn-primary">Regresar al Inicio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>