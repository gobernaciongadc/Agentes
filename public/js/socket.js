document.addEventListener('DOMContentLoaded', () => {
    const socket = io('http://localhost:3001'); // Desarrollo
    // const socket = io('http://agentes.gobernaciondecochabamba.bo'); // Produccion 1.-
    const userId = document.querySelector('meta[name="user-id"]').content;

    if (!userId) return; // No iniciar si no hay usuario autenticado

    // Identificar al usuario
    socket.emit('register', userId);


    // AQUI NOS LLEGA LAS NOTIFICACIONES
    // Escuchar notificaciones
    socket.on('notification', (message) => {

        const mensaje = JSON.parse(message);

        // habilitar punto de evento
        const punto = document.querySelector('#point-notificacion');
        punto.style.display = 'block';

        // Mostrar la notificación en el navbar
        const notifyContainer = document.querySelector('.message-center');

        const { tipoNotificacion } = mensaje;

        // console.log(mensaje);


        switch (tipoNotificacion) {
            case 'notificacion':
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
                break;
            case 'sancion':

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


                const newNotification_sancion = `
                         <a href="/sanciones/show/${mensaje.idSancion}">
                            <div class="btn btn-warning btn-circle"><i class="ti-alert"></i></div>
                            <div class="mail-contnet">
                                <h5>Nueva Notificación</h5>
                                <span class="mail-desc">
                                <p class="mb-0">Remitente: ${mensaje.remitente || ' no disponible'} </p>
                                <p>Asunto: ${mensaje.asunto || 'Asunto no disponible'}</p>
                                </span>
                                <span class="time">${new Date().toLocaleDateString('es-ES')} ${new Date().toLocaleTimeString('es-ES')}</span>
                            </div>
                        </a>`;
                notifyContainer.insertAdjacentHTML('afterbegin', newNotification_sancion);

                // Actualizar indicador de notificaciones
                const notifyIndicator_sancion = document.querySelector('.notify .point');
                notifyIndicator_sancion.style.display = 'block'
                break;

            case 'envio':

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

                const newEnvio = `
                         <a href="/notificacion-informe/${mensaje.idInforme}">
                            <div class="btn btn-primary btn-circle"><i class="ti-file"></i></div>
                            <div class="mail-contnet">
                                <h5>Nueva Notificación</h5>
                                <span class="mail-desc">
                                <p class="mb-0">Remitente: ${mensaje.remitente || ' no disponible'} </p>
                                <p class="mb-0 text-dark" >Asunto: ${mensaje.asunto || 'Asunto no disponible'}</p>
                                 <p class="text-dark">Tipo Agente: <span class="">${mensaje.tipoAgente}</span> </p>
                                </span>
                                <span class="time">${new Date().toLocaleDateString('es-ES')} ${new Date().toLocaleTimeString('es-ES')}</span>
                            </div>
                        </a>`;
                notifyContainer.insertAdjacentHTML('afterbegin', newEnvio);

                // Actualizar indicador de notificaciones
                const notifyEnvio = document.querySelector('.notify .point');
                notifyEnvio.style.display = 'block'
                break;
            case 'observacion':

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

                const newObservacion = `
                         <a href="/notificacion-informe/${mensaje.idInforme}">
                            <div class="btn btn-primary btn-circle"><i class="ti-file"></i></div>
                            <div class="mail-contnet">
                                <h5>Nueva Notificación</h5>
                                <span class="mail-desc">
                                <p class="mb-0">Remitente: ${mensaje.remitente || ' no disponible'} </p>
                                <p class="mb-0 text-dark" >Asunto: ${mensaje.asunto || 'Asunto no disponible'}</p>
                                 <p class="text-dark">Tipo Agente: <span class="">${mensaje.tipoAgente}</span> </p>
                                </span>
                                <span class="time">${new Date().toLocaleDateString('es-ES')} ${new Date().toLocaleTimeString('es-ES')}</span>
                            </div>
                        </a>`;
                notifyContainer.insertAdjacentHTML('afterbegin', newObservacion);

                // Actualizar indicador de notificaciones
                const notifyObservacion = document.querySelector('.notify .point');
                notifyObservacion.style.display = 'block'
                break;

        }




    });
});
