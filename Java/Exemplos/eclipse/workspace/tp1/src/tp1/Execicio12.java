package tp1;

import java.util.Scanner;

class Escada{
	int degraus;
	
	void FazerEscada(float altura){
		this.degraus = (int) (altura/30);
		System.out.println("Quantidade de degraus "+this.degraus);
	}
}

public class Execicio12 {
	
	private static Scanner scanner;

	public static void main(String[] args) {

		scanner = new Scanner(System.in);
		
		Escada escada = new Escada();
		
		System.out.println("Qual a altura que você quer pregar o prego?");
		float altura = scanner.nextFloat();
		
		escada.FazerEscada(altura);
			
	}

}
