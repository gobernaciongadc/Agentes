// Datatables Agentes
$('#informesTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    },
    searching: false,    // Desactiva el cuadro de búsqueda
    info: true,         // Oculta la información de cantidad de registros
    lengthChange: false, // Oculta el selector "Mostrar X registros"
    paging: false        // Desactiva la paginación (oculta "Anterior" y "Siguiente")
});


// Modal crear nueva información
const crearInformeBtn = document.getElementById('crearInformeBtn');
const modal = new bootstrap.Modal(document.getElementById('responsive-modal'));

crearInformeBtn.addEventListener('click', (e) => {
    e.preventDefault(); // Evita la acción por defecto del enlace
    modal.show(); // Abre el modal
});
// FIN Modal crear nueva información
