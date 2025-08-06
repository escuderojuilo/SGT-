// ScriptSS.js - Lógica principal del sistema de tickets
let tickets = [];
const servicio = idServicioSocial; 

document.addEventListener('DOMContentLoaded', function() {
    // Hacemos la petición incluyendo el idServicioSocial
    fetch('datostktSS.php')
    .then(response => response.json())
    .then(data => {
        //console.log("info de la base de datos", data);
        //console.log("Servicio relacinado",servicio);
        tickets = data.map(ticket => ({
            id: ticket.ID_TKT,
            solicitante: ticket.NOMBRE,
            cubiculo: ticket.CUBICULO,
            horario: ticket.FECHA_INI,
            idestado: ticket.ID_STATUS_TKT,
            problema: ticket.MOTIVO,
            fechaFinalizacion: ticket.FECHA_FIN,
            servicioo: ticket.NOMBRE_ASIGNADO
            }));

            console.log("Tickets:", tickets)

            filtrarTickets('2');
        })
        .catch(error => console.error("Error al obtener tickets:", error));
});


function filtrarTickets(estado) {

    console.log("Estado recibido:", estado);
    console.log("Tickets:", tickets);
    const buttons = document.querySelectorAll('.btn-group button');
    buttons.forEach(button => {
        if (button.id === estado) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
    });
    
    // Filtramos por estado y por el ID del servicio social logueado
    const ticketsFiltrados = tickets.filter(ticket => 
        String(ticket.idestado) === String(estado) 
    );
    
    console.log("Tickets filtrados:", ticketsFiltrados);


    const tbody = document.getElementById('tickets-body');
    tbody.innerHTML = '';

    ticketsFiltrados.forEach(ticket => {
        const tr = document.createElement('tr');

        let acciones = '';
        if (estado === '2') {
            acciones = `
                <div>
                    <small class="d-block">Asignado a: ${ticket.servicioo}</small>
                </div>
            `;
        } else if (estado === '3') {
            acciones = `
                <div class="text-center">
                    <small class="d-block">Completado por: ${ticket.servicioo}</small>
                    <small>Finalizado: ${ticket.fechaFinalizacion || 'No especificado'}</small>
                </div>
            `;
        }

        tr.innerHTML = `
            <td>${ticket.solicitante}</td>
            <td>${ticket.cubiculo}</td>
            <td>${ticket.horario}</td>
            <td>${ticket.problema}</td>
            <td>${ticket.servicioo || ''}</td>
            <td class="acciones">${acciones}</td>
        `;
        tbody.appendChild(tr);
    });
}