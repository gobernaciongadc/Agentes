document.addEventListener('DOMContentLoaded', () => {
    const socket = io('http://localhost:3001');
    const userId = document.querySelector('meta[name="user-id"]').content;

    if (!userId) return; // No iniciar si no hay usuario autenticado

    // Identificar al usuario
    socket.emit('register', userId);


    // Escuchar notificaciones
    socket.on('notification', (message) => {

        const mensaje = JSON.parse(message);

        const punto = document.querySelector('#point-notificacion');

        punto.style.display = 'block';

        toastr.info(`Asunto: ${mensaje.asunto}`, 'Nueva Notificación', {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "15000",
            "hideDuration": "1000",
            "timeOut": "15000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        });

        // Mostrar la notificación en el navbar
        const notifyContainer = document.querySelector('.message-center');


        const newNotification = `
            <a href="/notificaciones/show/${mensaje.idNotificacion}">
                <div class="btn btn-info btn-circle"><i class="ti-bell"></i></div>
                <div class="mail-contnet">
                    <h5>Nueva Notificación</h5>
                    <span class="mail-desc">
                      <p class="mb-0">Remitente: ${mensaje.remitente || ' no disponible'} </p>
                      <p>Asunto: ${mensaje.asunto || 'Asunto no disponible'}</p>
                    </span>
                    <span class="time">${new Date().toLocaleDateString('es-ES')} ${new Date().toLocaleTimeString('es-ES')}</span>
                </div>
            </a>`;
        notifyContainer.insertAdjacentHTML('afterbegin', newNotification);

        // Actualizar indicador de notificaciones
        const notifyIndicator = document.querySelector('.notify .point');
        notifyIndicator.style.display = 'block'
    });
});