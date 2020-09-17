package exemplo2;

class Casa{
	String cor;
	int numeroPortas;
	Porta[] portas = new Porta[5];
	
	void PintaCasa(String c){
		this.cor = c;
	}
	
	void AdicionaPorta(Porta p){
		this.portas[this.numeroPortas] = p;
		this.portas[this.numeroPortas].condicao = "fechada";
		this.numeroPortas = this.numeroPortas + 1;
	}
	
	void QuantasPortasAbertas(){
		int cont = 0;
		for(int i=0;i<this.numeroPortas;i++){
			if(this.portas[i].condicao == "aberta"){
				cont = cont + 1;
			}
		}
		System.out.println(cont);
	}
	
	void TotalPortas(){
		System.out.println(this.numeroPortas);
	}
}

class Porta{
	String condicao;
	
	void abrir(){
		this.condicao = "aberta";
	}

	void fechar(){
		this.condicao = "fechada";
	}	
	
}

public class CasaNova {
	public static void main(String[] args) {
		Casa novaCasa = new Casa();
		
		novaCasa.numeroPortas = 0;
		
		String color = "Branco";
		
		novaCasa.PintaCasa(color);
		
		for(int i=0;i<3;i++){
			Porta p = new Porta();
			novaCasa.AdicionaPorta(p);			
		}
		
		novaCasa.TotalPortas();
		novaCasa.portas[2].abrir();
		novaCasa.QuantasPortasAbertas();
		
	}
}
