package tp1;

import java.util.Scanner;

public class Exercicio4 {

	private static Scanner scanner;
	
	public static void main(String[] args) {
	int codCarga,codEstado,peso;
	float preco=0;

	scanner = new Scanner(System.in);
		
		
	System.out.println("Entre com o código do estado");
	codEstado = scanner.nextInt();
	System.out.println("Entre com o peso do caminhão em toneladas");
	peso = scanner.nextInt();
	System.out.println("Entre com o código do carga");
	codCarga = scanner.nextInt();
	

	int pesoKilos = peso*1000;
	System.out.println("Peso do caminhão em kilos "+pesoKilos);

	if(codCarga>=10 && codCarga<=20) preco = 100;
	else if(codCarga>=21 && codCarga<=30) preco = 250;
	else if(codCarga>=31 && codCarga<=40) preco = 340;

	float valorCarga = preco*pesoKilos;
	
	System.out.println("Preco da carga "+valorCarga);
	
	float imposto = 0;
	
	if(codEstado == 1) imposto = 35/100;
	else if(codEstado == 2) imposto = 25/100;
	else if(codEstado == 3) imposto = 15/100;
	else if(codEstado == 4) imposto = 5/100;
	else if(codEstado == 5) imposto = 0;
	
	float precoTotal = valorCarga - valorCarga*imposto;
	
	System.out.println("Valor total da carga: "+precoTotal);
	
	}
}
