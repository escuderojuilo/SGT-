<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="CorreoP.css" rel="stylesheet">
</head>
<body>
    <!-- Encabezado que ocupa todo el ancho con Bootstrap -->
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="imagenes/SOPORTEC/PagWebHD.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100">
            </div>
        </div>
    </div>

    <!-- Contenedor de recuperación de contraseña -->
    <div class="container">
        <div class="password-recovery-container">
            <h2 class="password-recovery-title">Recuperar Contraseña</h2>
            <p>Por favor ingresa tu correo electrónico registrado. Te enviaremos un enlace para restablecer tu contraseña.</p>
            
            <form id="recoveryForm">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="tu@email.com">
                </div>
                
                <button type="submit" class="btn btn-primary btn-recovery">Enviar enlace de recuperación</button>
                
                <div class="back-to-login">
                    <a href="login.html" class="text-decoration-none">← Volver al inicio de sesión</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de éxito -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-success-content">
                <div class="modal-header modal-success-header">
                    <div class="text-center w-100">
                        <i class="fas fa-check-circle modal-success-icon"></i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <h3 class="modal-success-title">¡Enlace enviado!</h3>
                    <p class="modal-success-text">Hemos enviado un enlace de recuperación a tu correo electrónico.</p>
                    <p class="modal-success-text">Por favor revisa tu bandeja de entrada y sigue las instrucciones.</p>
                </div>
                <div class="modal-footer modal-success-footer">
                    <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">Entendido</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('recoveryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validar el email
            const email = document.getElementById('email').value;
            if(email) {
                // Mostrar el modal de éxito
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
                
                // Limpiar el formulario
                document.getElementById('recoveryForm').reset();
            }
        });
    </script>
</body>
</html>