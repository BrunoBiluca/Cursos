package exemplo2;

import java.util.Scanner;

class Func{
	String nome,dep,entBanco,RG;
	double salario;
	boolean status;
	
	void bonifica(int bonificacao){
		this.salario = this.salario + bonificacao;
	}
	
	void demite(){
		this.salario = 0;
		this.status = false;
	}
	
	void mostra(){
		System.out.println(this.nome);
		System.out.println(this.entBanco);
		System.out.println(this.RG);
		System.out.println(this.salario);
		System.out.println(this.status);		
	}
}

class Empresa{
	Func[] empregados;
	String cnpj;
	
}

public class Funcionario {

	private static Scanner scanner;

	public static void main(String[] args) {

		scanner = new Scanner(System.in);
		Func f1 = new Func();		
		f1.nome = "Bruno";
		f1.salario = 1000.0;
		f1.status = true;
		
		Func f2 = new Func();
		f2.nome = "Dante";
		f2.salario = 0.0;
		f2.status = false;
		
		f1.bonifica(100);
		f2.bonifica(-100);
		
		System.out.println("O funcionário trabalha direito?");
		String opcao = scanner.nextLine();
		
		if(opcao.equals("nao")){
			f1.demite();
			System.out.println("Esse cara é um bosta");
		}
		f1.mostra();
		f2.mostra();
	}

}
