// DataTables
$("#datatable").DataTable({
    "responsive": true, "lengthChange": true, "autoWidth": false,
    "buttons": ["excel", "pdf", "print", "colvis"]
}).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
