<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas de Software</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="ConsultaSoftware.css">
</head>
<body>
    <div class="container-fluid g-0 mb-3">
        <div class="row">
            <div class="col-12 p-0">
                <img src="imagenes/SOPORTEC/PagWebHD.jpg" alt="SOPORTEC - Sistema de Soporte Técnico" class="w-100">
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
    
    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Software Column -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Software Instalado</h5>
                    </div>
                    <div class="card-body">
                        <div class="search-box">
                            <h6 class="mb-3"><i class="bi bi-search me-2"></i>Buscar equipos por software</h6>
                            <form id="buscarSoftwareForm" class="row g-3">
                                <div class="col-md-6">
                                    <label for="nombreSoftware" class="form-label">Software</label>
                                    <input type="text" class="form-control" id="nombreSoftware" list="softwareList" required>
                                    <datalist id="softwareList"></datalist>
                                </div>
                                <div class="col-md-4">
                                    <label for="versionSoftware" class="form-label">Versión</label>
                                    <input type="text" class="form-control" id="versionSoftware" list="versionList" required>
                                    <datalist id="versionList"></datalist>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover" id="tablaSoftware">
                                <thead class="table-light">
                                    <tr>
                                        <th>Software</th>
                                        <th>Solicitante</th>
                                        <th>Versión</th>
                                        <th>Departamento</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Equipos Column -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Equipos Relacionados</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" id="filtroEquipos" class="form-control" placeholder="Filtrar equipos...">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>N° Serie</th>
                                        <th>Host</th>
                                        <th>Inventario</th>
                                        <th>Tipo</th>
                                        <th>Ubicación</th>
                                    </tr>
                                </thead>
                                <tbody id="resultadosEquipos">
                                    <tr>
                                        <td colspan="5" class="text-center">Ingrese un software y versión para buscar</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="DatosSoftware.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para poblar la tabla de software
        function poblarTablaSoftware() {
            const tbody = document.querySelector('#tablaSoftware tbody');
            const softwareList = document.getElementById('softwareList');
            const versionList = document.getElementById('versionList');
            
            tbody.innerHTML = '';
            softwareList.innerHTML = '';
            versionList.innerHTML = '';
            
            // Obtener listas únicas para autocompletar
            const nombresUnicos = [...new Set(datosPrueba.software.map(s => s.nombre))];
            const versionesUnicas = [...new Set(datosPrueba.software.map(s => s.version))];
            
            nombresUnicos.forEach(nombre => {
                const option = document.createElement('option');
                option.value = nombre;
                softwareList.appendChild(option);
            });
            
            versionesUnicas.forEach(version => {
                const option = document.createElement('option');
                option.value = version;
                versionList.appendChild(option);
            });
            
            // Poblar tabla principal
            datosPrueba.software.forEach(sw => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${sw.nombre}</td>
                    <td>${sw.solicitante}</td>
                    <td>${sw.version}</td>
                    <td>${sw.departamento}</td>
                `;
                tbody.appendChild(row);
            });
        }

        // Función de búsqueda
        document.getElementById('buscarSoftwareForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nombre = document.getElementById('nombreSoftware').value.trim();
            const version = document.getElementById('versionSoftware').value.trim();
            
            if (!nombre || !version) {
                alert('Por favor complete ambos campos');
                return;
            }
            
            // Buscar software
            const software = datosPrueba.software.find(s => 
                s.nombre.toLowerCase() === nombre.toLowerCase() && 
                s.version.toLowerCase() === version.toLowerCase()
            );
            
            const resultados = document.getElementById('resultadosEquipos');
            
            if (!software) {
                resultados.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron equipos con este software</td>
                    </tr>
                `;
                return;
            }
            
            // Obtener equipos relacionados
            const equipos = datosPrueba.equipos.filter(e => 
                software.equipos.includes(e.id)
            );
            
            // Mostrar resultados
            if (equipos.length === 0) {
                resultados.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">No hay equipos con este software instalado</td>
                    </tr>
                `;
            } else {
                let html = '';
                equipos.forEach(eq => {
                    html += `
                        <tr>
                            <td>${eq.numero_serie}</td>
                            <td>${eq.host}</td>
                            <td>${eq.numero_inventario}</td>
                            <td>${eq.tipo}</td>
                            <td>${eq.ubicacion}</td>
                        </tr>
                    `;
                });
                resultados.innerHTML = html;
            }
            
            // Resaltar en la tabla de software
            document.querySelectorAll('#tablaSoftware tbody tr').forEach(row => {
                row.classList.remove('highlight');
                if (row.cells[0].textContent === nombre && row.cells[2].textContent === version) {
                    row.classList.add('highlight');
                    row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        });

        // Filtro de equipos
        document.getElementById('filtroEquipos').addEventListener('input', function() {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('#resultadosEquipos tr');
            
            filas.forEach(fila => {
                const texto = fila.textContent.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        });

        // Inicialización
        document.addEventListener('DOMContentLoaded', poblarTablaSoftware);
    </script>
</body>
</html>