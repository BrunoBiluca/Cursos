var WebSocketServer = require("ws").Server;
var wss = new WebSocketServer({ port: 3000 });

wss.on("connection", function(ws) {

	ws.send("Welcome to cyber chat");

});