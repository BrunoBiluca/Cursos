function Colisor(){
	this.sprites = [];
	this.aoColidir = null;
	this.spritesExcluir = [];
}
Colisor.prototype = {
	novoSprite: function(sprite){
		this.sprites.push(sprite);
		sprite.colisor = this;
	},
	// processar: function(){
	// 	for(var i in this.sprites){
	// 		for(var j in this.sprites){
	// 			if (i == j) continue;
	// 			this.testarColisao(this.sprites[i], this.sprites[j]);
	// 		}
	// 	}
	// },
	processar: function(){
		var jaTestados = new Object();

		for(var i in this.sprites){
			for(var j in this.sprites){
				if(i == j) continue;
				
				var id1 = this.stringUnica(this.sprites[i]);
				var id2 = this.stringUnica(this.sprites[j]);

				if(!jaTestados[id1]) jaTestados[id1] = [];
				if(!jaTestados[id2]) jaTestados[id2] = [];

				if(!(jaTestados[id1].indexOf(id2) >= 0 ||
					jaTestados[id2].indexOf(id1) >= 0)){
					this.testarColisao(this.sprites[i], this.sprites[j]);
					jaTestados[id1].push(id2);
					jaTestados[id2].push(id1);
				}
			}
		}
		this.processarExclusoes();
	},	
	testarColisao: function(sprite1, sprite2){
		var rets1 = sprite1.retangulosColisao();
		var rets2 = sprite2.retangulosColisao();

		colisoes:
		for(var i in rets1){
			for (var j in rets2) {
				if(this.retangulosColidem(rets1[i], rets2[j])){
					sprite1.colidiuCom(sprite2);
					sprite2.colidiuCom(sprite1);

					if(this.aoColidir) this.aoColidir(sprite1, sprite2);

					break colisoes;
				}
			}
		}
	},
	retangulosColidem: function(ret1, ret2){
		var retorno = (ret1.x + ret1.largura) > ret2.x && ret1.x < (ret2.x + ret2.largura) &&
				(ret1.y + ret1.altura) > ret2.y && ret1.y < (ret2.y + ret2.altura);
		return retorno;
	},
	stringUnica: function(sprite){
		var str = '';
		var retangulos = sprite.retangulosColisao();

		for(var i in retangulos){
			str +=  'x: ' + retangulos[i].x + ',' +
					'y: ' + retangulos[i].y + ',' +
					'l: ' + retangulos[i].largura + ',' +
					'a: ' + retangulos[i].altura + '\n';
		}

		return str;
	},
	excluirSprite: function(sprite){
		this.spritesExcluir.push(sprite);
	},
	processarExclusoes: function(){
		var novoArray = [];
		for(var i in this.sprites){
			if(this.spritesExcluir.indexOf(this.sprites[i]) == -1)
				novoArray.push(this.sprites[i]);
		}
		this.spritesExcluir = [];
		this.sprites = novoArray;
	}
}