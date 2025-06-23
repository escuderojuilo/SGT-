let tickets = [];

document.addEventListener('DOMContentLoaded', function() {
    fetch('datostkt.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        console.log("Contenido de data:", data); // Verificar los datos en la consola

        //guardar datos en una variable
        tickets = data.map(ticket  => ({
        id: ticket.ID_TKT, 
        solicitante: ticket.NOMBRE, 
        cubiculo: ticket.CUBICULO, 
        horario: ticket.FECHA_INI, 
        problema: ticket.MOTIVO,
        solucion: ticket.SOLUCION,
        fecha_inicio: ticket.FECHA_INI,  
        fecha_termino: ticket.FECHA_FIN 
         })); 
         window.tickets = tickets;
          if (typeof window.initHistorialDataTable === 'function') {
        window.initHistorialDataTable();
    }
    })
         
});


