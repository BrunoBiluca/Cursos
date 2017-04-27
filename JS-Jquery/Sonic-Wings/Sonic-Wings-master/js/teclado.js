var SETA_ESQUERDA = 37;
var SETA_ACIMA = 38;
var SETA_DIREITA = 39;
var SETA_ABAIXO = 40;
var ESPACO = 32;
var ENTER = 13;

function Teclado(elemento){
    this.elemento = elemento;
    this.pressionadas = [];
    this.disparadas = [];
    this.funcoesDisparo = [];
    
    var teclado = this;
    elemento.addEventListener('keydown', function(evento){
        teclado.pressionadas[evento.keyCode] = true;
        
        if(teclado.funcoesDisparo[evento.keyCode] && !teclado.disparadas[evento.keyCode]){
            teclado.disparadas[evento.keyCode] = true;
            teclado.funcoesDisparo[evento.keyCode]();
        }
    });
    elemento.addEventListener('keyup', function(evento){
        teclado.pressionadas[evento.keyCode] = false;
        teclado.disparadas[evento.keyCode] = false;
    });

}
Teclado.prototype = {
    pressionada: function(tecla){
        return this.pressionadas[tecla];
    },
    disparou: function(tecla, callback){
        this.funcoesDisparo[tecla] = callback;
    }
};