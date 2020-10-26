var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);
var users = [];

// app.get('/', (req, res) => {
//   res.sendFile(__dirname + '/index.html');
// });

io.on('connection', function (socket)  {
    socket.on('disconnect', () => {
      var i = users[socket.id];
      users.pop(i);
      io.emit('updateUserStatus', users);
      console.log('user disconnected');
    });

    socket.on('user_connected',function(user_id){
      users[user_id] = socket.id
      console.log(users);
      io.emit('updateUserStatus', users);
      console.log('user connected '+ user_id);
    });
});

http.listen(3000, () => {
  console.log('listening on *:3000');
});
