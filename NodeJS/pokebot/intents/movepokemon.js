const request = require('superagent')
const getMovesPokemon = (entity, user) => {
  const pokemon = entity ? entity.raw : user.pokemon
  if(!pokemon) { return Promise.reject('Which Pokemon?')}
  if (entity && entity.name === 'wrong') { return Promise.reject(`The pokemon ${entity.raw} doesn't exist. You might have mispelled it.`) }
  user.pokemon = pokemon
  return new Promise((resolve, reject) => {
    request.get('https://pokeapi.co/api/v2/pokemon/' + pokemon)
    .end((err, res) => {
      if (err) { 
        return reject('ERROR') 
      }
      resolve(movePokemonLayout(res.body))
    })
  })
  // Versão sem utilizar memória
  // if (!entity) { return Promise.reject('You didn\'t gave me any pokemon')}
  // 	// resolve vai ser capturado pela then
  // 	// reject vai ser capturado pelo catch na promessa
  // return new Promise((resolve, reject) => {
  //   request.get('https://pokeapi.co/api/v2/pokemon/' + entity.raw)
  //   .end((err, res) => {
  //     if (err) { return reject('ERROR') }
  //     // resolve('OK')
  //   	resolve(movePokemonLayout(res.body))
  //     // console.log(res.body)
  //   })
  // })
}

const movePokemonLayout = (json) => {
  const answer = []
  const toAdd = json.moves.map(elem => elem.move.name).join(' / ')
  answer.push(toText(`Moves(s): ${toAdd}`))
  return answer
}

const toText = message => { return { type: 'text', content: message } }

module.exports = getMovesPokemon