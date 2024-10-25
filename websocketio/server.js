const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const cors = require('cors');

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST']
    }
});

app.use(cors());
app.use(express.json());

// Rutas de la API
app.post('/message', (req, res) => {
    const message = req.body.message;

    // Emitir mensaje a todos los clientes conectados
    io.emit('chat message', message);

    res.status(200).send({ status: 'Mensaje recibido por el servidor de Node.js' });
});

io.on('connection', (socket) => {
    console.log('Un usuario se ha conectado');

    socket.on('disconnect', () => {
        console.log('Un usuario se ha desconectado');
    });
});

// Levantar el servidor en el puerto 3001
server.listen(3001, () => {
    console.log('Servidor de Socket.io escuchando en el puerto 3001');
});
