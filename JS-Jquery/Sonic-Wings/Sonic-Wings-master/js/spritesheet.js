function SpriteSheet(context, imagem, numLinhas, numColunas){
    this.context = context;
    this.imagem = imagem;
    this.numLinhas = numLinhas;
    this.numColunas = numColunas;
    this.intervalo = 0;
    this.linha = 0;
    this.coluna = 0;
    this.fimDoCiclo = null;
}
SpriteSheet.prototype = {
    proximoQuadro: function(){
        var agora = new Date().getTime();
        
        if(!this.ultimoTempo) this.ultimoTempo = agora;
        
        if(agora - this.ultimoTempo < this.intervalo) return;
        
        if(this.coluna < this.numColunas-1){
            this.coluna++;
        }
        else{
            this.coluna = 0;
            if(this.fimDoCiclo) this.fimDoCiclo();
        }
        
        this.ultimoTempo = agora;
    },
    desenhar: function(posX, posY){
        var larguraQuadro = this.imagem.width / this.numColunas;
        var alturaQuadro = this.imagem.height / this.numLinhas;
        
        var posXImagem = larguraQuadro * this.coluna;
        var posYImagem = alturaQuadro * this.linha;
        
        this.context.drawImage(
            this.imagem,
            posXImagem,
            posYImagem,
            larguraQuadro,
            alturaQuadro,
            posX,
            posY,
            larguraQuadro,
            alturaQuadro
        );
    }
};