// Datatables Agentes
$('#empresasTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    },
    searching: true,    // Desactiva el cuadro de búsqueda
    info: true,         // Oculta la información de cantidad de registros
    lengthChange: false, // Oculta el selector "Mostrar X registros"
    paging: true,      // Desactiva la paginación (oculta "Anterior" y "Siguiente")
    order: [[0, 'desc']] // Ordena por la primera columna en orden descendente       // Desactiva la paginación (oculta "Anterior" y "Siguiente")
});

$('#verificarEmpresasTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    },
    searching: true,      // Activa el cuadro de búsqueda
    info: true,           // Muestra la información de cantidad de registros
    lengthChange: true,   // Activa el selector "Mostrar X registros"
    paging: true,         // Activa la paginación
    pageLength: 100,      // Muestra 100 registros por defecto
    lengthMenu: [         // Opciones para mostrar registros por página
        [10, 25, 50, 100, -1], // Valores (número de registros)
        [10, 25, 50, 100, "Todos"] // Etiquetas visibles
    ],
    order: [[0, 'desc']],
    dom: 'Bfrtip',
    buttons: [
        'excel', 'print'
    ]  // Ordena por la primera columna en orden descendente
});


// Mostrar el nombre del archivo seleccionado
document.getElementById('respaldo-1').addEventListener('change', function () {
    const fileName1 = this.files[0]?.name || 'Ningún archivo seleccionado';
    document.getElementById('file-name-1').textContent = fileName1;
});

// Mostrar el nombre del archivo seleccionado
document.getElementById('respaldo-2').addEventListener('change', function () {
    const fileName2 = this.files[0]?.name || 'Ningún archivo seleccionado';
    document.getElementById('file-name-2').textContent = fileName2;
});

// Mostrar el nombre del archivo seleccionado
document.getElementById('respaldo-3').addEventListener('change', function () {
    const fileName3 = this.files[0]?.name || 'Ningún archivo seleccionado';
    document.getElementById('file-name-3').textContent = fileName3;
});
