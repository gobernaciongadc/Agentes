// Tabla de datos para traer la lista de personas

$('#personasTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    },
    order: [
        [0, 'desc']
    ] // Ordena por la primera columna en orden descendente 
});


