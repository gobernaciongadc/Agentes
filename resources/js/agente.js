
// Datatables Agentes
$('#agentesTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    }
});

// Mostrar el nombre del archivo seleccionado
document.getElementById('respaldo').addEventListener('change', function () {
    const fileName = this.files[0]?.name || 'Ningún archivo seleccionado';
    document.getElementById('file-name').textContent = fileName;
});
