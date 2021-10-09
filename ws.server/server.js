let io = require('socket.io')(6001, {
    cors: {
        origin: '*',
    }
});

io.sockets.on('connection',function (client){
    console.log('New connection', client.id);
    client.on('message',function (message){
        console.log(message,client.id);
        client.broadcast.emit('message',message);
    });
    client.on('disconnect', function () {});
});
