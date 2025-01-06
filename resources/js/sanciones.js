$('#sancionesTable').DataTable({
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    },
    order: [
        [0, 'desc']
    ] // Ordena por la primera columna en orden descendente 
});


document.getElementById('archivo_auto_inicial').addEventListener('change', function () {
    const fileName = this.files[0] ? this.files[0].name : 'Ningún archivo seleccionado';
    document.getElementById('name-file').textContent = fileName;
});

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function () {
    $('.listAgentes').select2();
});