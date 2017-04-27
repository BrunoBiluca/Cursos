const request = require('superagent')
// const getInfoPokemon = (entity, user) => {
//   const pokemon = entity ? entity.raw : user.pokemon
//   if (!pokemon) { return Promise.reject('Which pokemon?')}
//   if (entity.name === 'wrong') { 
//     return Promise.reject(`The pokemon is wrong. Please try again`)
//   }
//   if (entity.wrong) { 
//     return Promise.reject([u.toText(`The pokemon ${entity.raw} does not exist... You might have mispelled it.`)]) 
//   }
//   	// resolve vai ser capturado pela then
//   	// reject vai ser capturado pelo catch na promessa
//   return new Promise((resolve, reject) => {
//     request.get('https://pokeapi.co/api/v2/pokemon/' + entity.raw)
//     .end((err, res) => {
//       if (err) { return reject('ERROR') }
//       // resolve('OK')
//     	resolve(infoPokemonLayout(res.body))
//       // console.log(res.body)
//     })
//   })
// }

const getInfoPokemon = (entity, user) => {
  const pokemon = entity ? entity.raw : user.pokemon
  if (!pokemon) { return Promise.reject('Which pokemon?')}
  if (entity.name === 'wrong') { return Promise.reject(`The pokemon ${entity.raw} doesn't exist. You might have mispelled it.`) }
  user.pokemon = pokemon
  return new Promise((resolve, reject) => {
    request.get('https://pokeapi.co/api/v2/pokemon/' + pokemon)
    .end((err, res) => {
      if (err) { return reject('ERROR') }
      resolve(infoPokemonLayout(res.body))
    })
  })
}

const infoPokemonLayout = json => {
  const answer = [toText(`:mag_right: ${json.name} infos`)]
  const toAdd = json.types.map(elem => elem.type.name).join(' / ')
  // answer.push(`Type(s): ${toAdd}`)
  answer.push(toText(`Type(s): ${toAdd}`))
  //if (json.sprites.front_default) { answer.push(json.sprites.front_default) }
  if (json.sprites.front_default) {
    answer.push(toImage(json.sprites.front_default))
  }
  const prompt = [
    toButton('stats', `show me ${json.name} stats`),
    toButton('moves', `show me ${json.name} moves`),
  ]
  answer.push(toButtons('Click on them!', prompt))
  return answer
}

const toText = message => { return { type: 'text', content: message } }
const toImage = image => { return { type: 'image', content: image } }
// Buttons
 const toButtons = (title, buttons) => {
 return { type: 'buttons', content: buttons, title }
 }
// Button
 const toButton = (title, value) => { return { title, value } }

module.exports = getInfoPokemon