// Coletando informações com ReadLine

// Módulo que escuta a escrita de linhas no console
var readline = require("readline");

// ReadLine é um módulo interessante para utilizar stdin e stdout indiretamente
var rl = readline.createInterface(process.stdin, process.stdout);

var realPerson = {
    name: '',
    sayings: []
};

rl.question("What is the name of a real person? ", function(answer){

    realPerson.name = answer;

    // Seta o que será exibido no console
    rl.setPrompt(`What would ${realPerson.name} say? `);

    // Exibe o console
    rl.prompt();

    // Cria um listener para quando uma linha é digitada
    rl.on('line', function(saying){

        if(saying === "exit"){
            rl.close();
        }else{
            rl.setPrompt(`What else would ${realPerson.name} say? ('exit' to leave) `);
            realPerson.sayings.push(saying);
            rl.prompt();
        }

    });

});

rl.on('close', function(){
    console.log("%s is a real person that says %j", realPerson.name, realPerson.sayings);
    process.exit();
});