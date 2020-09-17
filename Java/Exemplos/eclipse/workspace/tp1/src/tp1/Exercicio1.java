package tp1;

import java.util.Scanner;

public class Exercicio1{
	
	private static Scanner scanner;
	
	public static void main(String[] args){
		float notaT,notaPS,notaPF,media;
		
		scanner = new Scanner(System.in);
		
		System.out.println("Entre com a nota do trabalho");
		notaT = scanner.nextFloat(); 
		System.out.println("Entre com a nota da prova semestral");
		notaPS = scanner.nextFloat(); 		
		System.out.println("Entre com a nota da prova final");
		notaPF = scanner.nextFloat(); 		
		
		media = notaT + notaPS + notaPF;
		media /= 3;
		
		if(media>8 && media <=10) System.out.println("A");
		else if(media>7 && media <=8) System.out.println("B");
		else if(media>6 && media <=7) System.out.println("C");
		else if(media>5 && media <=6) System.out.println("D");
		else if(media>0 && media <=5) System.out.println("E");
		
		
	}
} 