function Fundo(context, imagem){
    this.context = context;
    this.imagem = imagem;
    this.velocidade = 0;
    this.posicaoEmenda = 0;
}
Fundo.prototype = {
    atualizar: function(){
        this.posicaoEmenda += this.velocidade * this.animacao.decorrido / 1000;
        
        if(this.posicaoEmenda > this.imagem.height) this.posicaoEmenda = 0;
    },
    desenhar: function(){ //São usadas duas cópias da imagem emendadas
        var img = this.imagem;
        var ctx = this.context;
        
        var posicaoY = this.posicaoEmenda - img.height;
        ctx.drawImage(img, 0, posicaoY, img.width, img.height);
        
        posicaoY = this.posicaoEmenda;
        ctx.drawImage(img, 0, posicaoY, img.width, img.height);
    }  
};
