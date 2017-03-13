var express = require('express');  
var bodyParser = require('body-parser');  
var request = require('request'); 

const config = require('./config.js') 

var app = express();

app.use(bodyParser.urlencoded({extended: false}));  
app.use(bodyParser.json());  
app.listen((process.env.PORT || 3000));

// Server frontpage
app.get('/', function (req, res) {  
    res.send('Teste biluca bot');
});

// Facebook Webhook
app.get('/webhook', function (req, res) {  
    if (req.query['hub.verify_token'] === config.pageToken) {
        res.send(req.query['hub.challenge']);
    } else {
        res.send('Invalid verify token');
    }
});

// handler receiving messages
app.post('/webhook', function (req, res) {  
    var events = req.body.entry[0].messaging;
    for (i = 0; i < events.length; i++) {
        var event = events[i];
		// Verifica a mensagem do sistema
    if (event.message && event.message.text) {
			if (!imageMessage(event.sender.id, event.message.text)) {
				// Função de enviar a mensagem para o chat
				sendMessage(event.sender.id, {text: "Echo: " + event.message.text});
			}
    }
	 	else if (event.postback) {
			console.log("Postback received: " + JSON.stringify(event.postback));
		}
    }
    res.sendStatus(200);
});

// generic function sending messages
function sendMessage(recipientId, message) {  
    request({
		//Utiliza a api graph para enviar a mensagem ao chat
        url: 'https://graph.facebook.com/v2.6/me/messages',
		// Chave de acesso usada em todas as trocas de mensagem
		// Necessária estar configurada no server
        qs: {access_token: config.pageToken},
        method: 'POST',
        json: {
            recipient: {id: recipientId},
            message: message,
        }
    }, function(error, response, body) {
        if (error) {
            console.log('Error sending message: ', error);
        } else if (response.body.error) {
            console.log('Error: ', response.body.error);
        }
    });
};

// send rich message with kitten
function imageMessage(recipientId, text) {

    text = text || "";
    var values = text.split(' ');

    if (values.length === 3 && values[0] === 'image') {
        if (Number(values[1]) > 0 && Number(values[2]) > 0) {

            var imageUrl = "http://lorempixel.com/" + Number(values[1]) + "/" + Number(values[2]);

            message = {
                "attachment": {
                    "type": "template",
                    "payload": {
                        "template_type": "generic",
                        "elements": [{
                            "title": "Image",
                            "subtitle": "Random Images",
                            "image_url": imageUrl ,
                            "buttons": [{
                                "type": "web_url",
                                "url": imageUrl,
                                "title": "Show image"
                                }, {
                                "type": "postback",
                                "title": "I like this",
                                "payload": "User " + recipientId + " likes kitten " + imageUrl,
                            }]
                        }]
                    }
                }
            };

            sendMessage(recipientId, message);

            return true;
        }
    }
    return false;
};