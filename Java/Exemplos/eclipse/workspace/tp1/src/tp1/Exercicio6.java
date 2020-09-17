package tp1;

import java.util.Scanner;

class Crianca{
	int status;
	int sexo;
	int sobreviveram;
}

public class Exercicio6{
	
	private static Scanner scanner;
	
	public static void main(String[] args){
		int numCriancas;
		scanner = new Scanner(System.in);
		
		System.out.println("Número de crianças nascidas: ");
		numCriancas = scanner.nextInt();
		
		Crianca[] criancas = new Crianca[numCriancas];

		for(int i=0; i<numCriancas;i++){
			criancas[i] = new Crianca();
					
			System.out.println("Sexo de cada criança");
			criancas[i].sexo = scanner.nextInt();
			System.out.println("Status da criança");
			criancas[i].status = scanner.nextInt();
			System.out.println("Quanto tempo durou?");
			criancas[i].sobreviveram = scanner.nextInt();
		}
		
		int contMacho = 0;
		int contFemia = 0;
		int tudoNoob = 0;
		
		for(int i=0; i<numCriancas;i++){
			if(criancas[i].status == 0 && criancas[i].sexo == 1){
				contMacho++;
			}
			else if(criancas[i].status == 0 && criancas[i].sexo == 0){
				contFemia++;
			}
			
			if(criancas[i].sobreviveram <= 24){
				tudoNoob++;
			}			
		}
		System.out.println(contMacho);
		System.out.println(contFemia);
		System.out.println(tudoNoob);
	}
}