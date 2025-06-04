// ScriptSS.js - Lógica principal del sistema de tickets
let tickets = [];

document.addEventListener('DOMContentLoaded', function() {
    // Hacemos la petición incluyendo el idServicioSocial
    fetch(`datostkt.php?id_servicio_social=${idServicioSocial}`)
        .then(response => response.json())
        .then(data => {
            tickets = data.map(ticket => ({
                id: ticket.ID,
                solicitante: ticket.NOMBRE,
                cubiculo: ticket.CUBICULO,
                horario: ticket.FECHA_INI,
                problema: ticket.MOTIVO,
                estado: ticket.DESC_STATUS_TKT,
                servicioSocial: ticket.ASIGNADO_A || '',
                servicioSocialId: ticket.ID_ASIGNADO, // ID del usuario asignado
                fechaFinalizacion: ticket.FECHA_FIN || ''
            }));
            filtrarTickets('Iniciado');
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
    
    // Filtramos por estado y por el ID del servicio social logueado
    const ticketsFiltrados = tickets.filter(ticket => 
        ticket.estado === estado && 
        ticket.servicioSocialId == idServicioSocial
    );
    
    const tbody = document.getElementById('tickets-body');
    tbody.innerHTML = '';

    ticketsFiltrados.forEach(ticket => {
        const tr = document.createElement('tr');

        let acciones = '';
        if (estado === 'Iniciado') {
            acciones = `
                <div>
                    <small class="d-block">Asignado a: ${ticket.servicioSocial}</small>
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