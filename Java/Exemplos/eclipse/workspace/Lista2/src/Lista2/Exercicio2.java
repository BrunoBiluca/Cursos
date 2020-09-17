package Lista2;

import java.util.Scanner;

class Shape{
	int posicao;
	float tamanho;
	String cor;
	
	public void Draw(){
		
	}
}

class Quadrado extends Shape{
	
	public void Draw(){
		System.out.println("Quadrado");
		System.out.println(this.posicao);
		System.out.println(this.tamanho);
		System.out.println(this.cor);
		System.out.println("");		
	}
	
}

class Triangulo extends Shape{
	public void Draw(){
		System.out.println("Triangulo");
		System.out.println(this.posicao);
		System.out.println(this.tamanho);
		System.out.println(this.cor);
		System.out.println("");		
	}
	
}

class Circulo extends Shape{
	public void Draw(){
		System.out.println("Circulo");
		System.out.println(this.posicao);
		System.out.println(this.tamanho);
		System.out.println(this.cor);
		System.out.println("");		
	}
	
}

class Retangulo  extends Shape{
	public void Draw(){
		System.out.println("Retangulo");
		System.out.println(this.posicao);
		System.out.println(this.tamanho);
		System.out.println(this.cor);
		System.out.println("");		
	}
	
}


public class Exercicio2 {
	
	private static Scanner scanner;

	public static void main(String[] args) {

		Shape[] lista = new Shape[10];
		int cadastrado = 0;
		int opcao;
		
		scanner = new Scanner(System.in);
		
		do{
			System.out.println("Deseja cadastrar uma forma?(1 - Sim/0- Não)");
			opcao = scanner.nextInt();
			
			if(opcao == 1){
				System.out.println("Que tipo de forma você deseja cadastrar");
				String opcao2 = scanner.next();

				if(opcao2 == "Quadrado"){
					lista[cadastrado] = new Quadrado();
					
					System.out.println("Entre com a posição do quadrado");
					lista[cadastrado].posicao = scanner.nextInt();
					System.out.println("Entre com o tamanho do quadrado");
					lista[cadastrado].tamanho = scanner.nextFloat();
					System.out.println("Entre com a cor para preencher o quadrado");
					lista[cadastrado].cor = scanner.next();
					cadastrado++;
				}
				else if(opcao2 == "Triangulo"){
					lista[cadastrado] = new Triangulo();
					
					System.out.println("Entre com a posição");
					lista[cadastrado].posicao = scanner.nextInt();
					System.out.println("Entre com o tamanho");
					lista[cadastrado].tamanho = scanner.nextFloat();
					System.out.println("Entre com a cor para preencher");
					lista[cadastrado].cor = scanner.next();
					cadastrado++;
				}
				else if(opcao2 == "Circulo"){
					lista[cadastrado] = new Circulo();
					
					System.out.println("Entre com a posição");
					lista[cadastrado].posicao = scanner.nextInt();
					System.out.println("Entre com o tamanho");
					lista[cadastrado].tamanho = scanner.nextFloat();
					System.out.println("Entre com a cor para preencher");
					lista[cadastrado].cor = scanner.next();
					cadastrado++;
				}
				else if(opcao2 == "Retangulo"){
					lista[cadastrado] = new Retangulo();
					
					System.out.println("Entre com a posição");
					lista[cadastrado].posicao = scanner.nextInt();
					System.out.println("Entre com o tamanho");
					lista[cadastrado].tamanho = scanner.nextFloat();
					System.out.println("Entre com a cor para preencher");
					lista[cadastrado].cor = scanner.next();
					cadastrado++;
				}
				
			}else{
				for(int i=0;i<cadastrado;i++){
					lista[i].Draw();
				}
			}
					
		}while(opcao != 0);
		
	}
}
