// Datatables Agentes
$('#informesTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    },
    searching: true,    // Desactiva el cuadro de búsqueda
    info: true,         // Oculta la información de cantidad de registros
    lengthChange: true, // Oculta el selector "Mostrar X registros"
    paging: true,
    order: [[0, 'desc']] // Ordena por la primera columna en orden descendente       //        // Desactiva la paginación (oculta "Anterior" y "Siguiente")
});


