package PacoteBao;
 
public class Fibonacci {
	public static void main(String[] args) {
		int num1,num2,numNovo;
		
		num1 = 0;
		num2 = 1;
		
		do{
			numNovo = num1 + num2;
			num1 = num2;
			num2 = numNovo;
			System.out.println(numNovo);
		}while(numNovo<100);
	}
}
