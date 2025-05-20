<?php
    require __DIR__ ."/includes/funciones.php";
    servicio();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="/SGT-Boostrap/css/altaUsuario.css">
</head>
<body class="bg-secondary">
    
    <div class="container-fluid g-0 mb-3"> <!-- container-fluid sin gutters (g-0) -->
        <div class="row">
            <div class="col-12 p-0"> <!-- columna sin padding (p-0) -->
                <img src="/SGT-Boostrap/imagenes/encabezado.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100"> <!-- w-100 = width 100% -->
            </div>
        </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header custom-card-header text-white">
                        <h4 class="mb-0">Registro</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre: *</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pat" class="form-label">Apellido Paterno:</label>
                                        <input type="text" class="form-control" id="pat" name="pat" placeholder="Apellido Paterno" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mat" class="form-label">Apellido Materno:</label>
                                        <input type="text" class="form-control" id="mat" name="mat" placeholder="Apellido Materno">
                                    </div>
                                    <div class="mb-3">
                                        <label for="num" class="form-label">No. Trabajador/No. Cuenta:</label>
                                        <input type="text" class="form-control" id="numero" name="numero">
                                    </div>
                                    <div class="mb-3">
                                        <label for="depa" class="form-label">Departamento: *</label>
                                        <select class="form-select" id="depa" name="depa">
                                            <option value="1">Unidad de computo</option>
                                            <option value="2">Sanitaria y ambiental</option>
                                            <option value="3">Construcción</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pass" class="form-label">Contraseña:</label>
                                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cubiculo" class="form-label">Cubículo:</label>
                                        <input type="text" class="form-control" id="cub" name="cub">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono:</label>
                                        <input type="text" class="form-control" id="tel" name="tel">
                                    </div>
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">Correo: *</label>
                                        <input type="email" class="form-control" id="mai" name="mai" required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                            <button type="submit" class="btn custom-btn-continuar btn-lg">Continuar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>