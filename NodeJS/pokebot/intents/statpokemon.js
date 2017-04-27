const request = require('superagent')
const getStatPokemon = (entity, user) => {
  if (!entity) { return Promise.reject('You didn\'t gave me any pokemon')}
  	// resolve vai ser capturado pela then
  	// reject vai ser capturado pelo catch na promessa
  return new Promise((resolve, reject) => {
    request.get('https://pokeapi.co/api/v2/pokemon/' + entity.raw)
    .end((err, res) => {
      if (err) { return reject('ERROR') }
      // resolve('OK')
    	resolve(statPokemonLayout(res.body))
      // console.log(res.body)
    })
  })
}

const statPokemonLayout = json => {
  const answer = [toText(`:mag_right: ${json.name} infos`)]
  const toAdd = json.stats.map(elem => `${elem.stat.name}: ${elem.base_stat}`).join(' / ')
  // answer.push(`Type(s): ${toAdd}`)
  answer.push(toText(`Stats(s): ${toAdd}`))
  return answer
}

const toText = message => { return { type: 'text', content: message } }


module.exports = getStatPokemon