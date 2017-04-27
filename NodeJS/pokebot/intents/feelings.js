const random = array => { return array[Math.floor(Math.random() * array.length)] }
const getFeelings = () => {
  const answers = [
    'Im fine',
    'Very great',
    'Better with you'
  ]
  return Promise.resolve([toText(random(answers))])
}

// Função que determina quando o tipo de resposta é um texto
const toText = message => { return { type: 'text', content: message } }
module.exports = getFeelings