package tp1;

import java.util.Scanner;

public class Exercicio14 {
	
	private static Scanner scanner;
	
	public static void main(String[] args) {
		scanner = new Scanner(System.in);
		
		System.out.println("Ente com um número");
		int numero = scanner.nextInt();
		
		int novoNum = numero;
		int digito = 0;
		int soma = 0;
		int cont = 0;
		while(novoNum > 0){
			digito = novoNum % 10;
			novoNum = novoNum / 10;
			soma = soma + digito;
			cont++;
		}
		
		for(int i=0;i<(cont-1);i++){
			soma = soma*soma;
		}
		
		if(soma == numero){
			System.out.println("Numero é Narcisista");
		}else{
			System.out.println("Numero não é Narcisiita");
		}
	}

}
