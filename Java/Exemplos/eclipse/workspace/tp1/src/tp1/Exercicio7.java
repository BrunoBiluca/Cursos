package tp1;

import java.util.Scanner;

class Carro{
	float preco;
	
	void parcelas(){
		float acres = 0.03f;
		for(int i=6;i<=60;i+=6){
			float precoFinal;
			
			precoFinal = this.preco + this.preco*acres;
			
			System.out.println("Preco parcelando de "+i+" vezes "+precoFinal/i);			
			acres += 0.03f;
		}
	}
}

public class Exercicio7 {
	
	private static Scanner scanner;

	public static void main(String[] args) {
		float precoFinal = 0;
		scanner = new Scanner(System.in);
		
		Carro carro = new Carro();
		
		System.out.println("Preco do carro");
		carro.preco = scanner.nextFloat();
		
		precoFinal = carro.preco - carro.preco*0.20f;
		System.out.println("A vista "+precoFinal);
		
		carro.parcelas();
		
	}

}
