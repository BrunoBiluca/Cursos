// Process é um módulo do NodeJS que provê informação sobre e controla o processo atual
// Exemplo que mostra os processos atuais
// console.log(process.argv)

// Podemos usar o process.argv para inserir comportamentos iniciais no projeto
// Função responsável por Pegar os valores de entradas provenientes das flags do process
function grab(flag){
    var index = process.argv.indexOf(flag);
    return (index === -1) ? null : process.argv[index+1];
}

var user = grab("--user");
var greetings = grab("--greetings");

// Caso os argumentos de entrada não estão presentes
if(!user || !greetings){
   console.log("You Blew it!"); 
}
else{
   console.log(`Welcome ${user} - ${greetings}`); 
}