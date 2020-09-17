package tp1_AOC;

public class Cache{
	public int numVias;
	public int tamanhoCache;
	public int tamanhoBlocos;
	public int[] substituicao;
	public String politicaSubs;	
	public int [] lru;

	public String[] tag;
	public int[] validade;
	public String[] indice;

	
	public Cache(String[] args, int tamanhoMemoria){
		this.tamanhoCache = Integer.parseInt(args[3]);
		this.tamanhoBlocos = Integer.parseInt(args[5]);
		if(args[1].equals("AC")){
			this.numVias = Integer.parseInt(args[9]);
		}
		this.politicaSubs = args[7];	
		this.substituicao = new int[this.numVias];

		this.validade = new int[tamanhoCache/tamanhoBlocos];
		this.indice = new String[tamanhoCache/tamanhoBlocos];
		this.tag = new String[tamanhoCache/tamanhoBlocos];
		this.lru=new int[this.tamanhoCache/this.tamanhoBlocos];
	}
	
	public void imprimeCache(){
		System.out.println("---------------");
		for(int i=0;i<this.tamanhoCache;i++){
			System.out.println(i+" "+this.validade[i]+" "+this.tag[i]);
		}
		System.out.println("---------------");	
	}
	
	public boolean hitOrMiss(String tag, int posicao){
		if(this.validade[posicao] == 0){
			this.validade[posicao] = 1;
			this.tag[posicao] = tag;
			return false;
		}
		else if(this.validade[posicao] == 1 && !this.tag[posicao].equals(tag)){
			this.validade[posicao] = 1;
			this.tag[posicao] = tag;
			return false;					
		}
		else{
			return true;
		}

	}
	//Retorna se o bloco está ou não na cache
	public boolean hitOrMissAssociativa(String indice, int via, String tag){
		
		boolean retorno = false;
		int posicao;
		for(posicao = via;posicao<this.tamanhoCache/tamanhoBlocos;posicao += this.numVias){		
			if(this.validade[posicao] == 1 && this.tag[posicao].equals(tag) && this.indice[posicao].equals(indice)){
				if(this.politicaSubs.equals("LRU")){
					for(int i = 0;i<this.tamanhoCache;i ++){
						lru[i]++;
					}
					this.lru[posicao]=0;
				}
				retorno = true;
				break;
			}else if(this.validade[posicao] == 0){
				this.validade[posicao] = 1;
				this.indice[posicao] = indice;
				this.tag[posicao] = tag;
				if(this.politicaSubs.equals("LRU")){	
					for(int i = 0;i<this.tamanhoCache;i++){
							lru[i]++;
					}
					this.lru[posicao]=0;
				}
				retorno = false;
				break;
			}	
		}
		if(posicao >= this.tamanhoCache/this.tamanhoBlocos){
			if(this.politicaSubs.equals("FIFO")){		
					this.validade[this.substituicao[via]] = 1;
					this.indice[this.substituicao[via]] = indice;
					this.tag[this.substituicao[via]] = tag;
					retorno = false;
					this.substituicao[via] += this.numVias;
					if(this.substituicao[via] >= this.tamanhoCache/tamanhoBlocos){
						this.substituicao[via] = via;
					}
			}else if (this.politicaSubs.equals("LRU")){
				int maior = this.lru[via];
				int endereco=via;
				for(int i = via;i<this.tamanhoCache;i += this.numVias){
					if (maior<this.lru[i]){
						maior=this.lru[i];
						endereco=i;
					}
				}
				
				for(int i = 0;i<this.tamanhoCache;i ++){
					if(i!=endereco){
						lru[i]++;
					}
				}
								
				this.indice[endereco]= indice;
				this.tag[endereco]= tag;
				this.lru[endereco]=0;
			}
		}
		return retorno;
	}
	
}
