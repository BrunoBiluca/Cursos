package capitulo6;

class Func{
	private String nome,entBanco,RG;
	private double salario;
	private boolean status;
	
	public Func(){
		
	}
	
	public Func(String nome){
		this.nome = nome;
	}
	
	public void bonifica(int bonificacao){
		this.salario = this.salario + bonificacao;
	}
	
	public void demite(){
		this.salario = 0;
		this.status = false;
	}
	
	public void mostra(){
		System.out.println(this.nome);
		System.out.println(this.entBanco);
		System.out.println(this.RG);
		System.out.println(this.salario);
		System.out.println(this.status);		
	}
	
	public void setSalario(double salario){
		this.salario = salario;
	}
	
	void MudaNome(String name){
		this.nome = name;
	}
	
	void GetNome(){
		System.out.println(this.nome);
	}
	
	public double getSalario(){
		return this.salario;
	}
}

public class Funcionario {

	public static void main(String[] args) {

		Func f1 = new Func("Jose");
		
		//String s = "Bruno";
		
		//f1.MudaNome(s);

		f1.GetNome();
		
		f1.setSalario(100);
		
		f1.getSalario();
		
	}

}
