package tp1;

class Funcionario{
	float salario;

	void AumentaSalario(int porc){
		this.salario = this.salario + this.salario*0.015f*(porc+1);
	}
}

public class exercicio5{
	public static void main(String[] args){
		int ent,anoAtual,i,anos; 
		Funcionario f1 = new Funcionario();
		f1.salario = 1250;
		ent = 2005;
		anoAtual = 2013;
		
		anos = anoAtual - ent;
		
		for(i=0;i<anos;i++){
			f1.AumentaSalario(i);
		}
		System.out.println(f1.salario);
	}
}