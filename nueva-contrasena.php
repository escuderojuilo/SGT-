<?php

require __DIR__ ."/includes/funciones.php";
cambio_contra();

?>

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
    <link rel="stylesheet" href="/SGT-Boostrap/css/CambioContrasena.css">
</head>
<body>
    <!-- Encabezado -->
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="/SGT-Boostrap/imagenes/encabezadoHD.jpg" alt="SOPORTEC" class="w-100">
            </div>
        </div>
    </div>

    <!-- Formulario de nueva contraseña -->
    <div class="container">
        <div class="password-container">
            <h3 class="form-title"><i class="fas fa-key me-2"></i>Establecer Nueva Contraseña</h3>
            
            <form id="passwordForm" action="contrasena-cambiada-exito.php" method="POST">
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" required 
                           pattern=".{4,}" title="Mínimo 8 caracteres">
                    <div class="form-text">Mínimo 8 caracteres</div>
                </div>
                
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"  required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS y validación -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const newPass = document.getElementById('newPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;
            
            if (newPass !== confirmPass) {
                e.preventDefault();
                alert('Las contraseñas no coinciden');
            }
        });
    </script>
</body>
</html>