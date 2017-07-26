// Exemplo utilizando o framework express
const path = require('path') 
const express = require('express')  
const exphbs = require('express-handlebars')
const app = express()  
const port = 3000

// Inicialização da engine handlebars
app.engine('.hbs', exphbs({  
  defaultLayout: 'main',
  extname: '.hbs',
  layoutsDir: path.join(__dirname, 'views/layouts')
}))
app.set('view engine', '.hbs')  
app.set('views', path.join(__dirname, 'views')) 

// Routes
app.get('/', (request, response) => {  
  response.render('home', {
    name: 'John'
  })
})

app.get('/me-mostra-erro', (request, response) => {  
  throw new Error('oops')
})

app.get('/hello', (request, response) => {  
  response.send('Hello from Express!')
})

// Middleware de tratamento de erros
app.use((err, request, response, next) => {  
  // log the error, for now just console.log
  console.log(err)
  response.status(500).send('Something broke!')
})

app.listen(port, (err) => {  
  if (err) {
    return console.log('something bad happened', err)
  }

  console.log(`server is listening on ${port}`)
})