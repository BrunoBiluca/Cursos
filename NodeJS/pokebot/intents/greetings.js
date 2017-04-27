const random = array => { return array[Math.floor(Math.random() * array.length)] }
const getGreetings = () => {
  const answers = [
    'Hello!',
    'Yo ;)',
    'Hey, nice to see you.',
    'Welcome back!',
    'Hi, how can I help you?',
    'Hey, what do you need?',
  ]
  return Promise.resolve([toText(random(answers))])
}

// Função que determina quando o tipo de resposta é um texto
const toText = message => { return { type: 'text', content: message } }
module.exports = getGreetings