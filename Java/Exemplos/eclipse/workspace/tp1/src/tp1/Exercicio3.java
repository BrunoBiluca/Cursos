package tp1;

import java.util.Scanner;

public class Exercicio3 {
	
	private static Scanner scanner;
	
	public static void main(String[] args) {

		int horasT,horasEx,dependentes;
		float salarioM,salarioB,salarioL = 0;
		scanner = new Scanner(System.in);
		
		System.out.println("Entre com horas trabalhadas");
		horasT = scanner.nextInt();
		System.out.println("Entre com horas extras");
		horasEx = scanner.nextInt();
		System.out.println("Entre com o número de dependentes");
		dependentes = scanner.nextInt();
		System.out.println("Entre com o salário mínimo");
		salarioM = scanner.nextFloat();
		
		float valorHora = salarioM/5;
		
		salarioB = horasT*valorHora;
		salarioB = salarioB + 32*dependentes;
		
		salarioB = salarioB + horasEx*valorHora*3/2;
		if(salarioB <= 2000){
			salarioL = salarioB;
		}
		else if(salarioB >2000 && salarioB <= 5000){
			salarioL = salarioB - salarioB/10;
		}
		else if(salarioB > 5000){
			salarioL = salarioB - salarioB*2/10;
		}
		
		if(salarioL <= 3500){
			salarioL += 100;
		}
		else if(salarioL > 3500){
			salarioL += 50;
		}
	
		System.out.println("Salário Mensal é "+salarioL);
		
	}
}
