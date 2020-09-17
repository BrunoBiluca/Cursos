package tp1;

import java.util.Scanner; 

public class Exercicio13 {
	
	private static Scanner scanner;
	public static void main(String[] args) {
		
		float[][] notas = new float[3][40];
		int cont = 0;
		scanner = new Scanner(System.in);
			
		int opcao;
		do{
			System.out.println("Deseja cadastrar mais uma nota 1/0");
			opcao = scanner.nextInt();
			if(opcao == 1){
				System.out.println("Entre com a nota");
				float nota = scanner.nextFloat();
				System.out.println("Qual o curso do candidato?");
				String curso = scanner.next();
				int posCurso = 0;
				if(curso == "CC"){
					posCurso = 0;
				}
				else if(curso == "EC"){
					posCurso = 1;
				}
				else if(curso == "AS"){
					posCurso = 2;
				}
				if(cont == 40){
					int posicao = 0;
					float menor = notas[posCurso][0];
					for(int i=1;i<40;i++){
						if(notas[posCurso][i]<menor){
							menor = notas[posCurso][i];
							posicao = i;
						}
					}
					notas[posCurso][posicao] = nota;
				}
				else{
					notas[posCurso][cont] = nota;
					cont++;
				}				
			}
			
		}while(opcao != 0);
		
		for(int i=0;i<3;i++){
			for(int j=0;j<40;j++){
				System.out.print(notas[i][j]+" ");
			}			
			System.out.println("");
		}
	}

}
