// ScriptTicket.js - Lógica principal del sistema de tickets
let isAdmin = true; // Variable para determinar si el usuario es administrador
let tickets = [];
let ticketActual = null;

document.addEventListener('DOMContentLoaded', function() {
    fetch('datostkt.php')
        .then(response => response.json())
        .then(data => {
            console.log("Datos recibidos:", data);
            tickets = data.map(ticket => ({
                id: ticket.ID,
                solicitante: ticket.NOMBRE,
                cubiculo: ticket.CUBICULO,
                horario: ticket.FECHA_INI,
                problema: ticket.MOTIVO,
                estado: ticket.DESC_STATUS_TKT,
                servicioSocial: ticket.ASIGNADO_A || '',
                fechaFinalizacion: ticket.FECHA_FIN || ''
            }));
            filtrarTickets('En espera');
        })
        .catch(error => console.error("Error al obtener tickets:", error));
});

function filtrarTickets(estado) {
    const buttons = document.querySelectorAll('.btn-group button');
    buttons.forEach(button => {
        button.classList.remove('active');
        if (button.textContent.includes(estado)) {
            button.classList.add('active');
        }
    });

    const ticketsFiltrados = tickets.filter(ticket => ticket.estado === estado);
    const tbody = document.getElementById('tickets-body');
    tbody.innerHTML = '';

    ticketsFiltrados.forEach(ticket => {
        const tr = document.createElement('tr');

        let acciones = '';
        if (estado === 'En espera') {
            acciones = `
                <div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="mostrarModalAsignacion(${ticket.id})">
                        <i class="material-icons">check</i> Aceptar
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="rechazarTicket(${ticket.id})">
                        <i class="material-icons">close</i> Rechazar
                    </button>
                </div>
            `;
        } else if (estado === 'Iniciado') {
            acciones = `
                <div>
                    <small class="d-block">Asignado a: ${ticket.servicioSocial}</small>
                    <button class="btn btn-primary btn-sm mt-1" onclick="mostrarModalFinalizacion(${ticket.id})">
                        <i class="material-icons">done_all</i> Finalizar
                    </button>
                </div>
            `;
        } else if (estado === 'Finalizado') {
            acciones = `
                <div class="text-center">
                    <small class="d-block">Completado por: ${ticket.servicioSocial}</small>
                    <small>Finalizado: ${ticket.fechaFinalizacion || 'No especificado'}</small>
                </div>
            `;
        }

        tr.innerHTML = `
            <td>${ticket.solicitante}</td>
            <td>${ticket.cubiculo}</td>
            <td>${ticket.horario}</td>
            <td>${ticket.problema}</td>
            <td class="acciones">${acciones}</td>
        `;

        tbody.appendChild(tr);
    });
}

function mostrarModalAsignacion(ticketId) {
    ticketActual = ticketId;
    document.getElementById('ticket-id').textContent = ticketId;

    const select = document.getElementById('servicio-social-select');
    select.innerHTML = '<option value="" selected disabled>Seleccione servicio social</option>';

    window.serviciosSociales.forEach(servicio => {
        const option = document.createElement('option');
        option.value = servicio.id;
        option.textContent = servicio.nombre;
        select.appendChild(option);
    });

    const modal = new bootstrap.Modal(document.getElementById('asignarModal'));
    modal.show();
}

function asignarServicioSocial() {
    const select = document.getElementById('servicio-social-select');
    const hojaSelect = document.getElementById('tipo-hoja');
    const servicioId = select.value;
    const tipoHoja = hojaSelect.value;

    if (!servicioId) {
        alert("Por favor seleccione un servicio social");
        return;
    }

    if (!tipoHoja) {
        alert("Por favor seleccione el tipo de hoja");
        return;
    }

    const servicioSeleccionado = window.serviciosSociales.find(s => s.id == servicioId);
    const nombreServicio = servicioSeleccionado ? servicioSeleccionado.nombre : '';

    const ticketIndex = tickets.findIndex(t => t.id === ticketActual);
    if (ticketIndex !== -1) {
        tickets[ticketIndex].estado = "Iniciado";
        tickets[ticketIndex].servicioSocial = nombreServicio;
        tickets[ticketIndex].tipoHoja = tipoHoja; // <-- Puedes almacenarlo si lo necesitas más tarde
    }

    bootstrap.Modal.getInstance(document.getElementById('asignarModal')).hide();
    filtrarTickets('Iniciado');
}


function mostrarModalFinalizacion(ticketId) {
    ticketActual = ticketId;
    document.getElementById('ticket-id-finalizar').textContent = ticketId;

    const now = new Date();
    document.getElementById('fecha-finalizacion').value = now.toISOString().split('T')[0];
    document.getElementById('hora-finalizacion').value = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;

    const modal = new bootstrap.Modal(document.getElementById('finalizarModal'));
    modal.show();
}

function finalizarTicket() {
    const fecha = document.getElementById('fecha-finalizacion').value;
    const hora = document.getElementById('hora-finalizacion').value;

    if (!fecha || !hora) {
        alert("Por favor complete tanto la fecha como la hora de finalización");
        return;
    }

    const fechaHoraFinalizacion = `${fecha} ${hora}`;

    const ticketIndex = tickets.findIndex(t => t.id === ticketActual);
    if (ticketIndex !== -1) {
        tickets[ticketIndex].estado = "Finalizado";
        tickets[ticketIndex].fechaFinalizacion = fechaHoraFinalizacion;
    }

    bootstrap.Modal.getInstance(document.getElementById('finalizarModal')).hide();
    filtrarTickets('Finalizado');
}

// Datos de servicio social para usar en el modal
window.serviciosSociales = [
    { id: 1, nombre: "Ana Rodríguez" },
    { id: 2, nombre: "Carlos Méndez" },
    { id: 3, nombre: "Diana Fernández" },
    { id: 4, nombre: "Eduardo Jiménez" },
    { id: 5, nombre: "Gabriela Soto" }
];



