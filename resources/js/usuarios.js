// Datatables Agentes
$('#usuariosTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    },
    order: [[0, 'desc']] // Ordena por la primera columna en orden descendente 
});

// Inicializa Select2 para los selects
$('#persona').select2({
    placeholder: 'Selecciona una opción',
    allowClear: true,
});