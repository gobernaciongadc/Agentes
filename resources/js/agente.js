
// Datatables Agentes
$('#agentesTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    },
    order: [[0, 'desc']] // Ordena por la primera columna en orden descendente   
});

// Mostrar el nombre del archivo seleccionado
document.getElementById('respaldo').addEventListener('change', function () {
    const fileName = this.files[0]?.name || 'Ningún archivo seleccionado';
    document.getElementById('file-name').textContent = fileName;
});

// Inicializa Select2 para los selects
$('#persona').select2({
    placeholder: 'Selecciona una opción',
    allowClear: true,
});

// Inicializa Select2 para los selects
$('#municipio').select2({
    placeholder: 'Selecciona una opción',
    allowClear: true,
});