// ScriptUsuario.js - Lógica principal del sistema de usuarios
let isAdmin = true; // <-- Es una prueba para simular que el usuario es administrador
let usuarios = [];
let usuarioActual = null;
// Datos de laboratorios (ya definidos en el PHP)
let laboratorios = window.laboratorios || [];


document.addEventListener('DOMContentLoaded', function() {
    fetch('datosusuario.php')
    .then(response => response.json())
    .then(datos => {
        console.log(datos);
        console.log("Contenido de data:", datos); // Verificar los datos en la consola

        //guardar datos en una variable
        usuarios = datos.map(user  => ({
            id: user.ID_USR, 
            nombre: user.NOMBRE, 
            apellido: user.AP_PAT, 
            rol: user.NOM_ROL})); // Inicializar la variable tickets como un arreglo

        console.log("Usuarios:", usuarios);
        // Suponiendo que tienes una función para llenar los datos

        filtrarUsuarios('Administrador');
    })
    .catch(error => {
        console.error('Error al cargar usuarios:', error);
        // Aquí puedes mostrar un mensaje de error en la interfaz si lo deseas
    });
    //cargarUsuarios();
});

function camrol(usuarioId, nuevoRol) {

    fetch('datosusuario.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            accion: 'cambiar_rol',
            id: usuarioId,
            nuevoRol: nuevoRol
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Rol actualizado correctamente');
            // Recargar usuarios o actualizar la vista aquí
        } else {
            alert('Error: ' + data.message);
        }
    });
}

//Datos de prueba, eliminar esta parte después y usar la funcion comentada de abajo


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
            <td colspan="4" class="text-center py-4">
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
        let estadoCheck = '';

        if (isAdmin) {
            estadoCheck = `
                <input type="checkbox"
                    ${usuario.activo ? 'checked' : ''}
                    onchange="cambiarEstadoUsuario(${usuario.id}, this.checked)">
            `;
            acciones = `
                <button class="btn btn-primary btn-sm" onclick="mostrarModalCambioRol(${usuario.id}, '${usuario.nombre}')">
                    <i class="material-icons">edit</i> Cambiar Rol
                </button>
            `;
        } else {
            estadoCheck = `<span class="badge ${usuario.activo ? 'bg-success' : 'bg-secondary'}">${usuario.activo ? 'Activo' : 'Inactivo'}</span>`;
            acciones = `<small>No disponible</small>`;
        }

        const laboratorioNombre = usuario.rol === 'lab_encargado' && usuario.laboratorio_id ?
            laboratorios.find(l => l.id === usuario.laboratorio_id)?.nombre : null;

        tr.innerHTML = `
            <td>${usuario.nombre}</td>
            <td>
                ${getNombreRol(usuario.rol)}
                ${laboratorioNombre ? `<br><small class="text-muted">Lab: ${laboratorioNombre}</small>` : ''}
            </td>
            <td class="text-center">${estadoCheck}</td>
            <td class="acciones">${acciones}</td>
        `;
        tbody.appendChild(tr);
    });
}

function cambiarEstadoUsuario(usuarioId, nuevoEstado) {
    const usuario = usuarios.find(u => u.id === usuarioId);
    if (!usuario) return;

    // Si es admin y se intenta desactivar, verifica si es el único admin activo
    if (usuario.rol === 'admin' && usuario.activo && !nuevoEstado) {
        const adminsActivos = usuarios.filter(u => u.rol === 'admin' && u.activo);
        if (adminsActivos.length === 1) {
            alert('Debe haber al menos un administrador activo.');
            // Revertir el cambio visualmente
            filtrarUsuarios(getFiltroActual());
            return;
        }
    }

    usuario.activo = nuevoEstado;
    filtrarUsuarios(getFiltroActual());
}


function getNombreRol(rol) {
    switch(rol) {
        case 'Administrador': return 'Administrador';
        case 'Servicio social': return 'Servicio Social';
        case 'Usuario': return 'Usuario';
        case 'lab_encargado': return 'Encargado de Laboratorio';
        default: return rol;
    }
}

function getNombreFiltro(filtro) {
    switch(filtro) {
        case 'todos': return 'todos';
        case 'Administrador': return 'Administrador';
        case 'Servicio social': return 'Servicio Social';
        case 'Usuario': return 'Usuario';
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

function mostrarModalCambioRol(id, nombre) {
    
    document.getElementById('usuario-id').value = id;
    document.getElementById('usuario-nombre').textContent = nombre;

    const usuario = usuarios.find(u => u.id === id);
    if (usuario) {

    document.getElementById('rol-select').value = usuario.rol;
    
    // Si ya tiene laboratorio asignado, seleccionarlo
    if (usuario.rol === 'lab_encargado' && usuario.laboratorio_id) {
        document.getElementById('laboratorio-select').value = usuario.laboratorio_id;
    }
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

    camrol(usuarioId, nuevoRol);
    
    // Recargar la vista actual
    const activeButton = document.querySelector('.btn-group button.active');
    if (activeButton) {
        const filtro = activeButton.textContent.includes('todos') ? 'todos' : 
                    activeButton.textContent.includes('Administrador') ? 'Administrador' :
                    activeButton.textContent.includes('Servicio Social') ? 'Servicio social' : 
                    activeButton.textContent.includes('Encargados') ? 'lab_encargado' : 'Usuario';
        filtrarUsuarios(filtro);
    }
}
