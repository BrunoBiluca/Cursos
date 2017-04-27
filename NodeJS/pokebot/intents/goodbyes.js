const random = array => { return array[Math.floor(Math.random() * array.length)] }
const getGoodbyes = () => {
  const answers = [
    'Bye',
    'Bye come back soon',
    'I see you',
    'See you later'
  ]
  return Promise.resolve([toText(random(answers))])
}

// Função que determina quando o tipo de resposta é um texto
const toText = message => { return { type: 'text', content: message } }
module.exports = getGoodbyes