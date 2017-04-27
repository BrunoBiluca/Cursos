// Inicializa as constantes do app
// Faz o app listen a porta 8080 do servidor local
const restify = require('restify')
const builder = require('botbuilder')
const recast = require('recastai')
const datas = require('./datas.js')
const Fuzzy = require('fuzzy-matching')
const fmpokemons = new Fuzzy(datas.pokemons)

// Variável para armazenar a memória na 
var user = {
    intent: null,
    pokemon: null
};
// Outros arquivos do proeto
const config = require('./config.js')
const getGreetings = require('./intents/greetings.js')
const getInfoPokemon = require('./intents/infopokemon.js')
const getFeelings = require('./intents/feelings.js')
const getGoodbyes = require('./intents/goodbyes.js')
const getHelp = require('./intents/help.js')
const getMovePokemon = require('./intents/movepokemon.js')
const getStatPokemon = require('./intents/statpokemon.js')

// Connection to Microsoft Bot Framework
const connector = new builder.ChatConnector({
  appId: config.appId,
  appPassword: config.appPassword,
})
const bot = new builder.UniversalBot(connector)

// Determina o call back para cada intent detectado
const INTENTS = {
  greetings: getGreetings,
  infopokemon: getInfoPokemon,
  feelings: getFeelings,
  goodbyes: getGoodbyes,
  help: getHelp,
  movepokemon: getMovePokemon,
  statpokemon: getStatPokemon,
  infomove: getMovePokemon,
}

const noMemoryIntents = [
  'help',
  'greetings',
  'goodbyes',
  'feelings',
]

const checkWords = (words) => {
  const split = words.split(' ')
  let entity = null
  split.forEach((word) => {
    const match = fmpokemons.get(word)
    if (match.distance > 0.8) {
      entity = {raw: match.value}
    }
  })
  return (entity)
}

// Checa o nome da entidade que vem do request a API
const checkEntity = (recast) => {
  const pokemon = recast.get('pokemon')
  if (pokemon) {
    const match = fmpokemons.get(pokemon.raw)
    if (match.distance < 0.8) {
      pokemon.wrong = true
    } else { pokemon.raw = match.value }
    return pokemon
  }
  return null
}

// Determina o tipo de mensagem que será enviada de volta
const sendMessageByType = {
  image: (session, elem) => session.send(new builder.Message().addAttachment({
    contentType: 'image/png',
    contentUrl: elem.content,
  })),
	text: (session, elem) => session.send(elem.content),
	buttons: (session, elem) => {
		const buttons = elem.content.map(button => {
			return (new builder.CardAction().title(button.title).type('imBack').value(button.value))
		})
		const card = new builder.ThumbnailCard().buttons(buttons).subtitle(elem.title)
		session.send(new builder.Message().addAttachment(card))
	}
}

// Configuração do RecastAI
const recastClient = new recast.Client(config.recast)
// Event when Message received
bot.dialog('/', (session) => {
  //console.log(session.message.text)
  // A mensagem é passada para o recast tratar a linguagem natural
  recastClient.textRequest(session.message.text)
  .then(res => {
		const intent = res.intent()
		const entity = checkEntity(res)
		// Responde a intent
    if (!intent) {
      if (!entity) { entity = checkWords(u.cleanText(res.source)) }
      if (entity){
      	intent.slug = user.intent
      }
    }
		if(intent && noMemoryIntents.indexOf(intent.slug) === -1){
			user.intent = intent.slug
			INTENTS[intent.slug](entity, user)
			.then(res => {res.forEach((message) => sendMessageByType[message.type](session, message))})
			.catch(err => {err.forEach((message) => sendMessageByType[message.type](session, message))})
			// .then(res => {res.forEach((message) => session.send(message))})
			// .catch(err => {err.forEach((message) => session.send(message))})
			// .then(res => session.send(res))
			// .catch(err => session.send(err))
		}
	 })
  .catch(() => session.send('I need some sleep right now... Talk to me later!'))
})
// Server Init
const server = restify.createServer()
server.listen(8080)
server.post('/', connector.listen())
