package tp1;

import java.util.Scanner;

public class Exercicio2 {
	
	private static Scanner scanner;
	
	public static void main(String[] args) {

		int horaI,minI,horaT,minT;
		scanner = new Scanner(System.in);
		
		System.out.println("Entre com a hora de in�cio");
		horaI = scanner.nextInt();
		System.out.println("Entre com a minutos de in�cio");		
		minI = scanner.nextInt();
		System.out.println("Entre coma hora de t�rmino");
		horaT = scanner.nextInt();
		System.out.println("Entre coma minutos de t�rmino");
		minT = scanner.nextInt();
		
		if(horaT<horaI) horaT += 24;
		if(minT<minI) {
			minT += 60;
			horaT -= 1;
		}
	
		int tempoJogoH = horaT - horaI;
		int tempoJogoM = minT - minI;
		
		System.out.println("Dura��o do jogo "+tempoJogoH+" horas e "+tempoJogoM+" minutos");
		
	}
}
