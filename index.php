
<?php

require __DIR__ ."/includes/funciones.php";
logusr();

session_set_cookie_params(60 * 60 * 24 * 7); // Igual que en el resto de tu sistema
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    // Puedes redirigir según el rol si lo deseas
    if (isset($_SESSION['ID_ROL']) && $_SESSION['ID_ROL'] == 1) {
        header('Location: Ticket.php'); // Menú de administrador
        exit;
    } else {
        header('Location: SoporteUsuario.php'); // Menú de usuario normal
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - SOPORTEC</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css " rel="stylesheet">
    <link href="/SGT-Boostrap/css/InicioSesion.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<style>
    :root {
    --soporte-blue: #0d6efd;
    --soporte-dark: #212529;
    --soporte-light: #f8f9fa;
}

.btn-primary {
    background-color: var(--soporte-blue);
    border: none;
    padding: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    transform: scale(1.03);
}

/* Botón de contacto flotante */
.contact-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: var(--soporte-blue);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.5);
    cursor: pointer;
    z-index: 1000;
    transition: all 0.3s ease;
    border: none;
}

.contact-btn:hover {
    background-color: #0b5ed7;
    transform: scale(1.1) rotate(10deg);
    box-shadow: 0 6px 20px rgba(13, 110, 253, 0.7);
}    
/* Animación para el botón *

/* Responsividad */
@media (max-width: 768px) {
    .contact-btn {
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    
    .contact-panel {
        width: 280px;
        right: 20px;
        bottom: 85px;
    }
}

@media (max-width: 480px) {
    .contact-panel {
        width: 90%;
        right: 5%;
        left: 5%;
        bottom: 80px;
    }
    
    .contact-btn {
        bottom: 15px;
        right: 15px;
    }
}
</style>

<body>
    <!-- Encabezado que ocupa todo el ancho con Bootstrap -->
    <div class="container-fluid g-0 mb-3"> <!-- container-fluid sin gutters (g-0) -->
        <div class="row">
            <div class="col-12 p-0"> <!-- columna sin padding (p-0) -->
                <img src="/SGT-Boostrap/imagenes/encabezadoHD.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100"> <!-- w-100 = width 100% -->
            </div>
        </div>
    </div>

    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="pass" name="pass" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Recordarme</label>
                            </div>
                            <div class="d-grid">
                            <button class="btn btn-primary" type="submit" >Ingresar</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="/SGT-Boostrap/CorreoP.php">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-3">
                    ¿No tienes una cuenta? <a href="/SGT-Boostrap/RegistroUsuario.php">Regístrate</a>
                </div>
            </div>
        </div>
        <button class="contact-btn" onclick="location.href='InfoContacto.php'">
            <span class="material-icons">call</span>
        </button>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>