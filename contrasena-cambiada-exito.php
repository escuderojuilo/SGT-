<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Establecer Nueva Contraseña</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="CambioContrasena.css">
</head>
<body>
    <!-- Encabezado -->
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="imagenes/SOPORTEC/PagWebHD.jpg" alt="SOPORTEC" class="w-100">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="success-container text-center">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="mb-4">¡Contraseña actualizada!</h2>
            <p>Tu contraseña ha sido cambiada exitosamente. Ahora puedes iniciar sesión.</p>
            
            <div class="d-grid gap-2 mt-4">
                <a href="InicioSesion.php" class="btn btn-primary">Iniciar Sesión</a>
            </div>
            
            <div class="redirect-message">
                <p>Serás redirigido automáticamente en <span id="countdown">5</span> segundos...</p>
            </div>
        </div>
    </div>

    <!-- ... (scripts de redirección) ... -->
</body>
</html>