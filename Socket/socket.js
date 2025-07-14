import http from 'http'
import express from 'express'
import bodyParser from 'body-parser'
import dotenv from 'dotenv'

import { Server } from 'socket.io'

dotenv.config({path: '../../../../.env'})

const socketPort = 3002

const app = express()

const webserver = http.createServer(app)

let subscribers = []

const socketPath = process.env.SOCKET_PATH
const socketIoPath = socketPath + process.env.SOCKET_IO_PATH

webserver.listen(socketPort, () => {
    console.log('server started on port '+socketPort)
})

app.use(express.json())
app.use(bodyParser.urlencoded({ extended: false }))

// CORS
app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "*");
    res.header("Access-Control-Allow-Methods", "*");
    next();
});

app.get(socketPath + '/', (req, res) => {
    res.send('Hello World')
})

app.post(socketPath + '/broadcast', (req, res) => {
    const body = req.body
    const target = body.target ? body.target : null
    const message = body.message
    const subs = subscribers.filter(c => c.userId == target)
    subs.forEach(subscriber => {
        const socket = subscriber.socket
        socket.emit('receive', body)
    })
    res.send('broadcast message '+message)
})

const io = new Server(webserver, {
    path: socketIoPath,
    handlePreflightRequest: (req, res) => {
        const headers = {
            "Access-Control-Allow-Headers": "Content-Type, Authorization",
            "Access-Control-Allow-Origin": "*", //or the specific origin you want to give access to,
            "Access-Control-Allow-Credentials": true
        };
        res.writeHead(200, headers);
        res.end();
    },
    cors: {
        origin: '*', // process.env.ALLOWED_HOST,
        methods: ["GET", "POST"]
    }
})

io.on('connection', socket => {

    console.log(socket.id);

    socket.on('subscribe', (data) => {
        const userId = data.userId

        subscribers.push({userId, socket})
        
        socket.on('disconnect', () => {
            // remove from subscribers
            const tmpClients = subscribers.filter(c => c.socket.id == socket.id)
            for(var i=0;i<tmpClients.length;i++)
            {
                const client = tmpClients[i]
                const index  = subscribers.indexOf(client)
                subscribers.splice(index, 1)
            }
        })
    })

    socket.on('broadcast', (data) => {
        data.type = 'broadcast'
        subscribers.forEach(subscriber => {
            const socket = subscriber.socket
            socket.emit('receive', data)
        })
    })
    
    socket.on('send', (data) => {
        data.type = 'send'
        const subs = subscribers.filter(c => c.userId == data.target)
        subs.forEach(subscriber => {
            const socket = subscriber.socket
            socket.emit('receive', data)
        })
    })

})
