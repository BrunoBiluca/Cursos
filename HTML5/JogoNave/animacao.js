function Animacao(context){
	this.context = context;
	this.sprites = [];
	this.ligado = false;
	this.processamentos = [];
	this.spritesExcluir = [];
	this.processamentosExcluir = [];
	this.ultimoCiclo = 0;
	this.decorrido = 0;
}
Animacao.prototype = {
	novoSprite: function(sprite){
		this.sprites.push(sprite);
		sprite.animacao = this;
	},
	ligar: function(){
		this.ultimoCiclo = 0;
		this.ligado = true;
		this.proximoFrame();
	},
	desligar: function(){
		this.ligado = false;
	},
	limparTela: function(){
		var ctx = this.context;
		ctx.clearRect(0,0, ctx.canvas.width, ctx.canvas.height);
	},
	proximoFrame: function(){
		if(!this.ligado) return;

		this.limparTela(); //Comentar se existe fundo

		var agora = new Date().getTime();
		if (this.ultimoCiclo == 0) this.ultimoCiclo = agora;
		this.decorrido = agora - this.ultimoCiclo;

		for(var i in this.sprites)
			this.sprites[i].atualizar();

		for(var i in this.sprites)
			this.sprites[i].desenhar();

		for(var i in this.processamentos)
			this.processamentos[i].processar();

		this.processarExclusoes();

		this.ultimoCiclo = agora;

		var animacao = this;
		requestAnimationFrame(function(){
			animacao.proximoFrame();
		});
	},
	novoProcessamento: function(processamento){
		this.processamentos.push(processamento);
		processamento.animacao = this;
	},
	excluirSprite: function(sprite){
		this.spritesExcluir.push(sprite);
	},
	excluirProcessamento: function(processamento){
		this.processamentosExcluir.push(processamento);
	},
	processarExclusoes: function(){
		var novoSprites = [];
		var novoProcessamentos = [];

		for(var i in this.sprites){
			if(this.spritesExcluir.indexOf(this.sprites[i]) == -1) //Se não é um sprite a ser excluido coloca no novo array
				novoSprites.push(this.sprites[i]);
		}
		for(var i in this.processamentos){
			if(this.processamentosExcluir.indexOf(this.processamentos[i]) == -1)
				novoProcessamentos.push(this.processamentos[i]);
		}

		this.spritesExcluir = [];
		this.processamentosExcluir = [];

		this.sprites = novoSprites;
		this.processamentos = novoProcessamentos

	}

}