package tp2;

public class Cliente {

	String nome;
	int cpf;
	int codigo;
	int numQuarto;
	
	public Cliente(){
		System.out.println("Nome");
		this.nome = "Bruno";
		System.out.println("CPF");
		this.cpf = 01010101;
		System.out.println("Número do quarto");
		this.numQuarto = 10;
	}

	public void imprimirCliente() {
		System.out.println("Nome: "+this.nome);
		System.out.println("CPF: "+this.cpf);
		System.out.println("Codigo: "+this.codigo);
		System.out.println("Número do Quarto: "+this.numQuarto);
	}
}