// ScriptTicket.js - Lógica principal del sistema de tickets

let tickets = [];
let ticketActual = null;
let serviciosSociales = [];


document.addEventListener('DOMContentLoaded', function() {
    fetch('/SGT-Boostrap/datostkt.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        console.log("Contenido de data:", data); // Verificar los datos en la consola

        //guardar datos en una variable
        tickets = data.map(ticket  => ({ID: ticket.ID_TKT, solicitante: ticket.NOMBRE, cubiculo: ticket.CUBICULO, 
        hora: ticket.FECHA_INI, problema: ticket.MOTIVO, estado: ticket.DESC_STATUS_TKT, 
        idestado: ticket.ID_STATUS_TKT, servicioSocial: ticket.AP_PAT, horafin: ticket.FECHA_FIN})); // Inicializar la variable tickets como un arreglo

        //console.log("Tickets:", tickets)
    
        filtrarTickets('1');
    })
        .catch(error => console.error("Error al obtener tickets:", error));
});

function actualizarEstadoTicket(ticketId, nuevoEstado, callback) {

    fetch('/SGT-Boostrap/cambiar_estado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: ticketId,
            estado: nuevoEstado
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(`Estado del ticket ${ticketId} actualizado a ${nuevoEstado}`);
            location.reload();
            if (callback) callback(); // Ejecutar callback si se proporciona
        } else {
            console.error(`Error al actualizar el estado del ticket ${ticketId}:`, data.message);
            alert(`Error al actualizar el estado: ${data.message}`);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        alert(`Ocurrió un error al intentar actualizar el estado del ticket ${ticketId}. ${nuevoEstado}`);
    });
}

function tasignaciones(ticketId, ucid, fechasig) {
    fetch('/SGT-Boostrap/asignacion.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            idtkt: ticketId,
            idserv: ucid,
            fecha: fechasig
        })
    })
    .then(response => {
        console.log("Estado HTTP:", response.status);
        return response.json();})
    .then(data => {
        if (data.success) {
            console.log(`Asignación del ticket ${ticketId} actualizada a ${ucid}`);
            location.reload();
        } else {
            console.error(`Error al actualizar la asignación del ticket ${ticketId}:`, data.message);
            alert(`Error al actualizar la asignación: ${data.message}`);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        alert(`Ocurrió un error al intentar actualizar la asignación del ticket ${ticketId}. ${ucid}`);
    });

}


function filtrarTickets(estado) {
    const buttons = document.querySelectorAll('.btn-group button');
    buttons.forEach(button => {
        if (button.id === estado) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
    });

    const ticketsFiltrados = tickets.filter(ticket => ticket.idestado === estado);
    const tbody = document.getElementById('tickets-body');
    tbody.innerHTML = '';

    ticketsFiltrados.forEach(ticket => {
        const tr = document.createElement('tr');

        let acciones = '';
        if (estado === '1') {
            acciones = `
                <div class="btn-group">
                    <button class="btn btn-success btn-sm" onclick="mostrarModalAsignacion(${ticket.ID})">
                        <i class="material-icons">check</i> Aceptar
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="rechazarTicket(${ticket.ID})">
                        <i class="material-icons">close</i> Rechazar
                    </button>
                </div>
            `;
        } else if (estado === '2') {
            acciones = `
                <div>
                    <small class="d-block">Asignado a: ${ticket.servicioSocial}</small>
                    <button class="btn btn-primary btn-sm mt-1" onclick="mostrarModalFinalizacion(${ticket.ID})">
                        <i class="material-icons">done_all</i> Finalizar
                    </button>
                </div>
            `;
        } else if (estado === '3') {
            acciones = `
                <div class="text-center">
                    <small class="d-block">Completado por: ${ticket.servicioSocial}</small>
                    <small>Finalizado: ${ticket.horafin || 'No especificado'}</small>
                </div>
            `;
        }

        tr.innerHTML = `
            <td>${ticket.solicitante}</td>
            <td>${ticket.cubiculo}</td>
            <td>${ticket.hora}</td>
            <td>${ticket.problema}</td>
            <td class="acciones">${acciones}</td>
        `;

        tbody.appendChild(tr);
    });
}

fetch('/SGT-Boostrap/datoserv.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        console.log("Contenido de data:", data); // Verificar los datos en la consola

        //guardar datos en una variable
        window.serviciosSociales = data.map(serv  => ({id: serv.ID_USR, nombre: serv.NOMBRE, apellido: serv.AP_PAT})); // Inicializar la variable tickets como un arreglo

        console.log("Serv:", serviciosSociales);
        // Suponiendo que tienes una función para llenar los datos

        filtrarTickets('1'); // Llamar a la función para filtrar los tickets por estado 'Espera'
    })

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
    const servicioId = select.value;

    if (!servicioId) {
        alert("Por favor seleccione un servicio social");
        return;
    }

    const now = new Date();
    const fechaHoraFinalizacion = `${now.getFullYear()}-${(now.getMonth() + 1).toString().padStart(2, '0')}-${now.getDate().toString().padStart(2, '0')}
     ${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}:${now.getSeconds().toString().padStart(2, '0')}`;

    const servicioSeleccionado = window.serviciosSociales.find(s => s.id === servicioId);
    const nombreServicio = servicioSeleccionado ? servicioSeleccionado.nombre : '';

    const ticketIndex = tickets.findIndex(t => t.id === ticketActual);
    if (ticketIndex !== -1) {
        tickets[ticketIndex].estado = "2";
        tickets[ticketIndex].servicioSocial = nombreServicio;
    }

    tasignaciones(ticketActual, servicioId, fechaHoraFinalizacion);

    bootstrap.Modal.getInstance(document.getElementById('asignarModal')).hide();
    
    actualizarEstadoTicket(ticketActual, '2', () => {
        filtrarTickets('2'); // Redirigir a Iniciados automáticamente
    });
}

function rechazarTicket(ticketId) {
    if (confirm("¿Está seguro que desea rechazar este ticket?")) {
        actualizarEstadoTicket(ticketId, "4", () => {
            tickets = tickets.filter(ticket => ticket.id !== ticketId);
            filtrarTickets('4');
        });
    }
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

    //if (!fecha || !hora) {
      //  alert("Por favor complete tanto la fecha como la hora de finalización");
      //  return;
    //}

    const fechaHoraFinalizacion = `${fecha} ${hora}`;
    const ticketIndex = tickets.findIndex(t => t.ID == ticketActual);

    console.log("Ticket index:", ticketIndex);
    console.log("Ticket actual:", ticketActual);


    if (ticketIndex !== -1) {
        tickets[ticketIndex].idestado = "3";
        tickets[ticketIndex].horafin = fechaHoraFinalizacion;


        bootstrap.Modal.getInstance(document.getElementById('finalizarModal')).hide();
        actualizarEstadoTicket(ticketActual, "3", () => {
            filtrarTickets('3');
        });
    }

}

// Datos de servicio social para usar en el modal
//window.serviciosSociales = [
  //  { id: 1, nombre: "Ana Rodríguez" },
   // { id: 2, nombre: "Carlos Méndez" },
    //{ id: 3, nombre: "Diana Fernández" },
   // { id: 4, nombre: "Eduardo Jiménez" },
   // { id: 5, nombre: "Gabriela Soto" }
//];


