document.addEventListener('DOMContentLoaded', () => {
    const socket = io('http://localhost:3001');
    const userId = document.querySelector('meta[name="user-id"]').content;

    console.log(userId);


    if (!userId) return; // No iniciar si no hay usuario autenticado

    socket.emit('register', userId);

    socket.on('notification', (message) => {
        alert('Nueva notificación: ' + message);
    });
});
