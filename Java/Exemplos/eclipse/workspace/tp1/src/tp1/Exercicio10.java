package tp1;

import java.util.Scanner;

class Contas{
	int codigo;
	float saldo;
	
	void saque(float valorSaque){
		this.saldo -= valorSaque;
	}
	
	void deposito(float valorSaque){
		this.saldo += valorSaque;
	}
	
}

public class Exercicio10 {
	
	private static Scanner scanner;

	public static void main(String[] args) {
		int numContas = 2;
		Contas[] conta = new Contas[numContas];
		for(int i=0;i<numContas;i++){
			
		}
		
		scanner = new Scanner(System.in);
		
		for(int i=0;i<numContas;i++){
			System.out.println("Codigo");
			conta[i].codigo = scanner.nextInt();
			System.out.println("Saldo");
			conta[i].saldo = scanner.nextFloat();
		}	
		
		int opcao;
		do{
			System.out.println("-------------------MENU---------------------");
			System.out.println("1) Efetuar depósito");
			System.out.println("2) Efetuar saque");
			System.out.println("3) Consultar o ativo bancário");
			System.out.println("0) Sair");
			opcao = scanner.nextInt();		
			
			if(opcao == 2){
				System.out.println("Entre com o codigo da conta para sacar");
				int codigo = scanner.nextInt();
				System.out.println("Entre com o valor");
				float valor = scanner.nextFloat();
				for(int i=0;i<numContas;i++){
					if(conta[i].codigo==codigo){
						conta[i].saque(valor);
						i = numContas;
					}
				}
			}
			else if(opcao == 1){
				System.out.println("Entre com o codigo da conta para depositar");
				int codigo = scanner.nextInt();
				System.out.println("Entre com o valor");
				float valor = scanner.nextFloat();
				for(int i=0;i<numContas;i++){
					if(conta[i].codigo==codigo){
						conta[i].deposito(valor);
						i = numContas;
					}
				}				
			}
			else if(opcao == 3){
				float total = 0;
				for(int i=0;i<numContas;i++){
					total = total + conta[i].saldo;
				}				
				System.out.println("O somatório do saldo de todas as contas é: "+total);
			}
			
			
		}while(opcao != 0);
	}

}
