var somExplosao = new Audio();
somExplosao.src = 'snd/explosao.mp3';
somExplosao.volume = 0.4;
somExplosao.load();

function Explosao(context, imagem, x, y){
    this.context = context;
    this.imagem = imagem;
    this.spritesheet = new SpriteSheet(context, imagem, 1, 5);
    this.spritesheet.intervalo = 75;
    this.x = x;
    this.y = y;
    var explosao = this;
    this.fimDaExplosao = null;
    this.spritesheet.fimDoCiclo = function(){
            explosao.animacao.excluirSprite(explosao);
            if(explosao.fimDaExplosao) explosao.fimDaExplosao();
    }

    somExplosao.currentTime = 0.0;
    somExplosao.play();
}
Explosao.prototype = {
	atualizar: function(){

	},
	desenhar: function(){
		this.spritesheet.desenhar(this.x, this.y);
		this.spritesheet.proximoQuadro();
	}
}