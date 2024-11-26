// Datatables Agentes
$('#usuariosTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    }
});

// Inicializa Select2 para los selects
$('#persona').select2({
    placeholder: 'Selecciona una opción',
    allowClear: true,
});