const path = require('path');
const express = require("express");
const exphbs = require("express-handlebars");
const rp = require("request-promise");

const app = express();

// Engine html configuração
app.engine('.hbs', exphbs({
    defaultLayout: 'main',
    extname: '.hbs',
    layoutsDir: path.join(__dirname, 'views/layouts')
}));
app.set('view engine', '.hbs');
app.set('views', path.join(__dirname, 'views'));

app.get('/:city', (req, res) => {
    console.log(req.params.city)
    // Requisição a API externa
    rp({
        uri: 'http://dataservice.accuweather.com/locations/v1/cities/search',
        qs: { // query string enviada
            q: req.params.city,
            apiKey: '6S9QbltNBvTTiXpu2WH8eaHncYzHPtoS'
        },
        json: true // já cria o parser do json resultante
    })
    .then((data) => {
        res.render('home', data);
    })
    .catch((error) => {
        console.log(error);
        res.render('error', error);
    });
})

app.listen(3000);