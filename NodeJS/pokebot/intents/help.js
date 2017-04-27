const random = array => { return array[Math.floor(Math.random() * array.length)] }
const getHelp = () => {
  const answers = [
    'Calm down!'
  ]
  return Promise.resolve([toText(random(answers))])
}

// Função que determina quando o tipo de resposta é um texto
const toText = message => { return { type: 'text', content: message } }
module.exports = getHelp