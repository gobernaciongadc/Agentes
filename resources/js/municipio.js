// Para ocultar el mensajes
// Espera 3 segundos y luego oculta el mensaje
setTimeout(() => {
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');

    if (successMessage) {
        successMessage.style.transition = "opacity 0.5s ease";
        successMessage.style.opacity = "0"; // Aplica efecto de desvanecimiento
        setTimeout(() => successMessage.remove(), 500); // Elimina el mensaje completamente
    }

    if (errorMessage) {
        errorMessage.style.transition = "opacity 0.5s ease";
        errorMessage.style.opacity = "0";
        setTimeout(() => errorMessage.remove(), 500);
    }
}, 3000); // 3000 ms = 3 segundos
