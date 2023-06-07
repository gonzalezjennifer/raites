
$(document).ready(function() {
    $('#tablaraites').DataTable({
        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        columnDefs: [
            { orderable: false, targets: [4,5,6] },
            { targets: [0, 1, 2, 3, 4, 5, 6], className: 'text-center' },
            { "width": "15%", "targets": [0, 1] },
            { "width": "20%", "targets": [5, 3]},
            { "width": "10%", "targets": [2, 4, 6] },
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json',
            "search": "Buscar lugar, dia, hora, etc:",
        },
        
    });
  });