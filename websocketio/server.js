// El 1.- produccion se encuentra en el archivo ?

const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const cors = require('cors');

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: '*',  // Desarrollo
        // origin: 'http://agentes.gobernaciondecochabamba.bo',  // Producción 2.-
        methods: ['GET', 'POST']
    },
    transports: ['polling', 'websocket']
});

app.use(cors());
app.use(express.json());

// Estructura para almacenar usuarios conectados
const connectedUsers = {};

io.on('connection', (socket) => {
    console.log('Un usuario se ha conectado:', socket.id);

    // Escuchar evento de identificación del usuario
    socket.on('register', (userId) => {
        connectedUsers[userId] = socket.id;
        console.log(`Usuario registrado: ${userId} con socket ID: ${socket.id}`);
    });

    // Manejar desconexión
    socket.on('disconnect', () => {
        for (const userId in connectedUsers) {
            if (connectedUsers[userId] === socket.id) {
                delete connectedUsers[userId];
                console.log(`Usuario desconectado: ${userId}`);
                break;
            }
        }
    });
});

// Ruta para enviar mensajes a usuarios específicos
app.post('/notify-user', (req, res) => {
    const { userId, message } = req.body;

    if (connectedUsers[userId]) {
        const socketId = connectedUsers[userId];
        io.to(socketId).emit('notification', message);
        res.status(200).send({ status: 'Mensaje enviado al usuario.' });
    } else {
        res.status(404).send({ status: 'Usuario no está conectado.' });
    }
});

// Levantar el servidor(Modificado para produccion)
// server.listen(3001, '0.0.0.0', () => { // Produccion 3.-
server.listen(3001, () => {  // Desarrollo
    console.log('Servidor de Socket.io escuchando en el puerto 3001');
});
