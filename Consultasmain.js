// Consultasmain.js
$(document).ready(function() {
    $('#datatable_users').DataTable({
        data: inventarioEquipos,
        columns: [
            { data: 'numero_de_inventario' },
            { data: 'numero_de_serie' },
            { data: 'tipo_de_equipo' },
            { data: 'marca' },
            { data: 'modelo' },
            { data: 'sistema_operativo' },
            { data: 'procesador' },
            { data: 'disco_duro' },
            { data: 'ram' }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.3.0/i18n/es-MX.json'
        },
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100]
    });
});