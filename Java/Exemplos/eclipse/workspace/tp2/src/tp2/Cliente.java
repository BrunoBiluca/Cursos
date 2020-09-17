package tp2;

public class Cliente {

	String nome;
	String cpf;
	int codigo;
	int numQuarto;
	
	public Cliente(String nome, String cpf,int codigo){
		this.nome = nome;
		this.codigo = codigo; 
		this.cpf = cpf;
	}

	public void imprimirCliente() {
		System.out.println("Nome: "+this.nome);
		System.out.println("CPF: "+this.cpf);
		System.out.println("Codigo: "+this.codigo);
		System.out.println("Número do Quarto: "+this.numQuarto);
	}
}