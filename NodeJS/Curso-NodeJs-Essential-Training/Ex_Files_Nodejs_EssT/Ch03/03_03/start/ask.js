//Exemplos trabalhando com o output e input
var questions = [
    "What is your name?",
    "What is your fav hobby?",
    "What is your fav programming language?"
];

var answers = [];

// Função utilizando o output padrão do Node
function ask(i){
    process.stdout.write(`\n\n\n\n ${questions[i]}`);
    process.stdout.write(`    >    `);
}

// Criando um listener para executar uma função
// Quando data entrar no nosso programa
// O programa não é encerrado já que essa função
// é executada de forma assíncrona
// .on é criar um listerner que irá escutar quando tiver entrada de data no process
process.stdin.on('data', function(data){
    // Saída sempre que entrar alguma data no process
    //process.stdout.write('\n' + data.toString().trim() + '\n');

    // Podemos passar por todas as questions e armazenar os dados
    answers.push(data.toString().trim());

    if(answers.length < questions.length){
        ask(answers.length)
    } else {
        process.exit();
    }
});

//Podemos criar um outro listenet para escutar quando o evento process exit for invocado
process.on('exit', function(){

    process.stdout.write(`\n\n\n\n`);
    process.stdout.write(`Go ${answers[1]} ${answers[0]} you can finish your ${answers[2]} code later`);
    process.stdout.write(`\n\n\n\n`);

})

ask(0);