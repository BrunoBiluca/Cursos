package exemplo3;

class Func{
	private String nome,dep,entBanco,RG;
	private double salario;
	private boolean status;
	
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
	
	void MudaNome(String name){
		this.nome = name;
	}
	
	void GetNome(){
		System.out.println(this.nome);
	}
}

public class FuncPrivado {

	public static void main(String[] args) {

		Func f1 = new Func();
		
		String s = "Bruno";
		
		f1.MudaNome(s);

		f1.GetNome();
	}

}
