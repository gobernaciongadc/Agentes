<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Chat en Tiempo Real</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <h1>Chat en Tiempo Real</h1>
    <ul id="messages"></ul>
    <form id="form" action="">
        <input id="input" autocomplete="off" placeholder="Escribe tu mensaje" /><button>Enviar</button>
    </form>

    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const socket = io('http://localhost:3001');
            const form = document.getElementById('form');
            const input = document.getElementById('input');

            // Asegurarse de que el meta csrf-token exista
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            if (!csrfToken) {
                console.error("CSRF token not found!");
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (input.value) {
                    fetch('/send-message', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                message: input.value
                            })
                        }).then(response => response.json())
                        .then(data => console.log(data));

                    input.value = '';
                }
            });

            // Escuchar mensajes desde el servidor de Node.js
            socket.on('chat message', function(msg) {
                const item = document.createElement('li');
                item.textContent = msg;
                document.getElementById('messages').appendChild(item);
            });
        });
    </script>
</body>

</html>