package tp1;

import java.util.Scanner;

class Aviao{
	int numero,lugares;
	String origem,destino;
	
}

public class Exercicio9 {

	private static Scanner scanner;
	
	public static void main(String[] args) {
		
		Aviao[] aviao = new Aviao[12];
		for(int i=0;i<12;i++){
			aviao[i] = new Aviao();
		}
		
		scanner = new Scanner(System.in);
		
	int opcao;
	do{	
		System.out.println("-------------------MENU---------------------");
		System.out.println("1) Cadastrar Voos");
		System.out.println("2) Consultar");
		System.out.println("3) Efetuar Reserva");
		System.out.println("0) Sair");
		opcao = scanner.nextInt();
		
		
		if(opcao==1){
			for(int i=0;i<12;i++){
				System.out.println("Numero");
				aviao[i].numero = scanner.nextInt();
				System.out.println("Origem");
				aviao[i].origem = scanner.nextLine();
				System.out.println("Destino");
				aviao[i].destino = scanner.nextLine();
				System.out.println("Lugares");
				aviao[i].lugares = scanner.nextInt();
			}	
		}
		else if(opcao==2){
			System.out.println("-------------------MENU2---------------------");
			System.out.println("1) Por Numero do voo");
			System.out.println("2) Por origem");
			System.out.println("3) Por destino");		
			int opcao2 = scanner.nextInt();
			
			if(opcao2 == 1){
				System.out.println("Entre com o número do voo");
				int numero = scanner.nextInt();
				for(int i=0;i<12;i++){
					if(aviao[i].numero==numero){
						System.out.println("Numero"+aviao[i].numero);
						System.out.println("Origem"+aviao[i].origem);
						System.out.println("Destino"+aviao[i].destino);
						System.out.println("Lugares"+aviao[i].lugares);
					}
				}
			}
			else if(opcao2 == 2){
				System.out.println("Entre com a origem do voo");
				String origem = scanner.nextLine();
				for(int i=0;i<12;i++){
					if(aviao[i].origem==origem){
						System.out.println("Numero"+aviao[i].numero);
						System.out.println("Origem"+aviao[i].origem);
						System.out.println("Destino"+aviao[i].destino);
						System.out.println("Lugares"+aviao[i].lugares);
					}
				}
			}
			else if(opcao2 == 3){
				System.out.println("Entre com o número do voo");
				String destino = scanner.nextLine();
				for(int i=0;i<12;i++){
					if(aviao[i].destino==destino){
						System.out.println("Numero"+aviao[i].numero);
						System.out.println("Origem"+aviao[i].origem);
						System.out.println("Destino"+aviao[i].destino);
						System.out.println("Lugares"+aviao[i].lugares);
					}
				}
			}
		}
		else if(opcao==3){
			System.out.println("Informe o número do voo para reserva");
			int numero = scanner.nextInt();
			for(int i=0;i<12;i++){
				if(numero==aviao[i].numero){
					if(aviao[i].lugares>0){
						aviao[i].lugares--;
						System.out.println("Reserva efetuada");
					}
					else{
						System.out.println("Voo Lotado");
					}
				}
				else{
					System.out.println("Voo inexistente");
				}
			}
		}

	}while(opcao!=0);	
	}
}
