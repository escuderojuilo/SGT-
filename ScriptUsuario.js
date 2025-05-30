// ScriptUsuario.js - Lógica principal del sistema de usuarios
let isAdmin = true; // <-- Es una prueba para simular que el usuario es administrador
let usuarios = [];
let usuarioActual = null;
// Datos de laboratorios (ya definidos en el PHP)
let laboratorios = window.laboratorios || [];



document.addEventListener('DOMContentLoaded', function() {
    cargarUsuarios();
    filtrarUsuarios('todos'); // Mostrar todos los usuarios por defecto
});
//Datos de prueba, eliminar esta parte después y usar la funcion comentada de abajo
function cargarUsuarios() {
    usuarios = [
    { id: 1, nombre: "Admin Principal", rol: "admin", laboratorio_id: null },
    { id: 2, nombre: "Ana Rodríguez", rol: "service_social", laboratorio_id: null },
    { id: 3, nombre: "Carlos Méndez", rol: "service_social", laboratorio_id: null },
    { id: 4, nombre: "Dr. García", rol: "academico", laboratorio_id: null },
    { id: 5, nombre: "Ing. López", rol: "lab_encargado", laboratorio_id: 1 }
    ];
}

//function cargarUsuarios() {
//        fetch('getUsuarios.php')
//        .then(response => {
//            if (!response.ok) {
//                throw new Error('Error en la red');
//            }
//            return response.json();
//        })
//        .then(data => {
//            if (data.error) {
//                console.error('Error:', data.error);
//                mostrarError('Error al cargar usuarios');
//                return;
//            }
//            
//            usuarios = data;
//            filtrarUsuarios('todos');
//        })
//        .catch(error => {
//            console.error('Error:', error);
//            mostrarError('No se pudieron cargar los usuarios');
//        });
//}

//function mostrarError(mensaje) {
//    const tbody = document.getElementById('usuarios-body');
//    tbody.innerHTML = `
//        <tr>
//            <td colspan="3" class="text-center text-danger py-4">
//                <i class="material-icons">error</i>
//                ${mensaje}
//            </td>
//        </tr>
//    `;
//}

// Función para filtrar usuarios (actualizada para mostrar laboratorio)
function filtrarUsuarios(filtro) {
    const buttons = document.querySelectorAll('.btn-group button');
    buttons.forEach(button => {
        button.classList.remove('active');
        if (button.textContent.includes(getNombreFiltro(filtro))) {
            button.classList.add('active');
        }
    });

    let usuariosFiltrados = [];
    if (filtro === 'todos') {
        usuariosFiltrados = [...usuarios];
    } else {
        usuariosFiltrados = usuarios.filter(usuario => usuario.rol === filtro);
    }

    const tbody = document.getElementById('usuarios-body');
    tbody.innerHTML = '';

    if (usuariosFiltrados.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td colspan="3" class="text-center py-4">
                <i class="material-icons">info</i>
                No hay usuarios ${getNombreFiltro(filtro).toLowerCase()}
            </td>
        `;
        tbody.appendChild(tr);
        return;
    }

    usuariosFiltrados.forEach(usuario => {
        const tr = document.createElement('tr');
        let acciones = '';
        
        if (isAdmin) {
            acciones = `
                <button class="btn btn-primary btn-sm" onclick="mostrarModalCambioRol(${usuario.id}, '${usuario.nombre}')">
                    <i class="material-icons">edit</i> Cambiar Rol
                </button>
            `;
        } else {
            acciones = `<small>No disponible</small>`;
        }

        // Obtener nombre del laboratorio si es encargado
        const laboratorioNombre = usuario.rol === 'lab_encargado' && usuario.laboratorio_id ?
            laboratorios.find(l => l.id === usuario.laboratorio_id)?.nombre : null;

        tr.innerHTML = `
            <td>${usuario.nombre}</td>
            <td>
                ${getNombreRol(usuario.rol)}
                ${laboratorioNombre ? `<br><small class="text-muted">Lab: ${laboratorioNombre}</small>` : ''}
            </td>
            <td class="acciones">${acciones}</td>
        `;
        tbody.appendChild(tr);
    });
}


function getNombreRol(rol) {
    switch(rol) {
        case 'admin': return 'Administrador';
        case 'service_social': return 'Servicio Social';
        case 'academico': return 'Académico';
        case 'lab_encargado': return 'Encargado de Laboratorio';
        default: return rol;
    }
}

function getNombreFiltro(filtro) {
    switch(filtro) {
        case 'todos': return 'Todos';
        case 'admin': return 'Administradores';
        case 'service_social': return 'Servicio Social';
        case 'academico': return 'Académicos';
        case 'lab_encargado': return 'Encargados de Laboratorio';
        default: return filtro;
    }
}
// Función para mostrar/ocultar el campo de laboratorio
function toggleLaboratorioField() {
    const rolSelect = document.getElementById('rol-select');
    const laboratorioContainer = document.getElementById('laboratorio-container');
    
    if (rolSelect.value === 'lab_encargado') {
        laboratorioContainer.style.display = 'block';
    } else {
        laboratorioContainer.style.display = 'none';
    }
}

// Función para cargar los laboratorios
function cargarLaboratorios() {
    fetch('getLaboratorios.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('laboratorio-select');
            select.innerHTML = '';
            
            if (data.error) {
                select.innerHTML = '<option value="">Error al cargar laboratorios</option>';
                return;
            }
            
            data.forEach(lab => {
                const option = document.createElement('option');
                option.value = lab.id;
                option.textContent = lab.nombre;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar laboratorios:', error);
            const select = document.getElementById('laboratorio-select');
            select.innerHTML = '<option value="">Error al cargar laboratorios</option>';
        });
}

function mostrarModalCambioRol(usuarioId, usuarioNombre) {
    if (!isAdmin) return;
    
    const usuario = usuarios.find(u => u.id === usuarioId);
    if (!usuario) return;

    document.getElementById('usuario-id').value = usuarioId;
    document.getElementById('usuario-nombre').textContent = usuarioNombre;
    document.getElementById('rol-select').value = usuario.rol;
    
    // Si ya tiene laboratorio asignado, seleccionarlo
    if (usuario.rol === 'lab_encargado' && usuario.laboratorio_id) {
        document.getElementById('laboratorio-select').value = usuario.laboratorio_id;
    }
    
    toggleLaboratorioField();
    
    const modal = new bootstrap.Modal(document.getElementById('cambiarRolModal'));
    modal.show();
}

function cambiarRol() {
    if (!isAdmin) return;

    const nuevoRol = document.getElementById('rol-select').value;
    const usuarioId = parseInt(document.getElementById('usuario-id').value);
    let laboratorioId = null;

    if (nuevoRol === 'lab_encargado') {
        laboratorioId = parseInt(document.getElementById('laboratorio-select').value);
        if (!laboratorioId) {
            alert('Por favor selecciona un laboratorio');
            return;
        }
    }

    // Actualizar el usuario en los datos de prueba
    const usuarioIndex = usuarios.findIndex(u => u.id === usuarioId);
    if (usuarioIndex !== -1) {
        usuarios[usuarioIndex].rol = nuevoRol;
        usuarios[usuarioIndex].laboratorio_id = nuevoRol === 'lab_encargado' ? laboratorioId : null;
    }

    // Cerrar el modal
    bootstrap.Modal.getInstance(document.getElementById('cambiarRolModal')).hide();
    
    // Recargar la vista actual
    const activeButton = document.querySelector('.btn-group button.active');
    if (activeButton) {
        const filtro = activeButton.textContent.includes('Todos') ? 'todos' : 
                    activeButton.textContent.includes('Administradores') ? 'admin' :
                    activeButton.textContent.includes('Servicio Social') ? 'service_social' : 
                    activeButton.textContent.includes('Encargados') ? 'lab_encargado' : 'academico';
        filtrarUsuarios(filtro);
    }
}
