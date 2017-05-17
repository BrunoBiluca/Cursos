// Função de tempo
var waitTime = 3000;
var currentTime = 0;
var waitInterval = 10; // Seta o intervalo que a função será executada
var percentWaited = 0;

console.log("Wait for it");

function writeWaitingPercent(p){
    // Limpa a última linha escrita no stdout
    process.stdout.clearLine();
    // Coloca o cursor na primeira posição da última linha escrita no stdout que foi apagada
    process.stdout.cursorTo(0);

    process.stdout.write(`waiting ... ${p}%`);
}

// Intervalo que a esperada será executada
// Para parar o interval setamos ele para uma variável
var interval = setInterval(function(){
    currentTime += waitInterval;
    percentWaited = Math.floor(currentTime / waitTime * 100);
    writeWaitingPercent(percentWaited);
    //console.log(`waiting ${currentTime/1000} seconds...`);
}, waitInterval);

// Quando o tempo de espera ter terminado
setTimeout(function(){
    // Interrompe a execução do interval
    clearInterval(interval);
    writeWaitingPercent(100);
    console.log(`\n\n Legendary \n\n`);
}, waitTime)

// Inicia a contagem de tempo
process.stdout.write("\n\n");
writeWaitingPercent(percentWaited);