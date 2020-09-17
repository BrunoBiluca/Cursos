package tp1;

import java.util.Scanner;

class Func{
	float salario;
}

public class Exercicio8{
	
	private static Scanner scanner;
	
	public static void main(String[] args){
		
		int maisVendido = 0;
		float valorGeral = 0;
		float[] valores = new float[10];
		int[] quant = new int[10];
		Funcionario f1 = new Funcionario();
		
		f1.salario = 545.0f;
		
		scanner = new Scanner(System.in);
		
		for(int i=0;i<10;i++){
			System.out.println("Valor do item "+i);
			valores[i] = scanner.nextFloat();
			//valores[i] = i+2;
			System.out.println("Quantidade vendida do item "+i);
			quant[i] = scanner.nextInt();
			//quant[i] = i;
		}
		
		for(int i=0;i<10;i++){
			System.out.println("Item               "+i);
			System.out.println("Quantidade vendida "+quant[i]);
			System.out.println("Valor unitátio     "+valores[i]);
			System.out.println("Valor total        "+valores[i]*quant[i]);
			valorGeral += valores[i]*quant[i];
		}
		System.out.println("Comissão do funcionário é "+valorGeral*0.05);
		
				
		for(int i=0;i<10;i++){
			if(quant[i]>quant[maisVendido]){
				maisVendido = i;
			}
		}
		System.out.println("O valor do objeto mais vendido "+valores[maisVendido]);
		System.out.println("A posição no vetor é "+maisVendido);
		
	}
}