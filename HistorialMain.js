// HistorialMain.js
document.addEventListener('DOMContentLoaded', function() {
    // Verificar que los datos están cargados
    if (typeof tickets === 'undefined') {
        console.error('Error: La variable tickets no está definida');
        return;
    }

    // Inicializar DataTable
    $('#datatable_tickets').DataTable({
        data: tickets,
        columns: [
            { 
                data: 'id',
                className: 'fw-bold'
            },
            { 
                data: 'solicitante' 
            },
            { 
                data: 'cubiculo',
                className: 'text-center'
            },
            { 
                data: 'horario',
                className: 'text-center'
            },
            { 
                data: 'problema',
                render: function(data) {
                    return data.length > 50 ? data.substr(0, 50) + '...' : data;
                }
            },
            { 
                data: 'fecha_inicio',
                className: 'text-center',
                render: function(data) {
                    return data ? new Date(data).toLocaleString() : 'N/A';
                }
            },
            { 
                data: 'fecha_termino',
                className: 'text-center',
                render: function(data) {
                    return data ? new Date(data).toLocaleString() : 'En progreso';
                }
            }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.3.0/i18n/es-MX.json'
        },
        responsive: true,
        dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>',
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        order: [[0, 'desc']],
        createdRow: function(row, data, dataIndex) {
            // Resaltar filas según estado
            if (data.estado === 'Pendiente') {
                $(row).addClass('table-warning');
            } else if (data.estado === 'Resuelto') {
                $(row).addClass('table-success');
            }
        }
    });
});