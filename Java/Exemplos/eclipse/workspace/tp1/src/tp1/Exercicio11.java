package tp1;

import java.util.Scanner;

class Turma{
	Aluno[] aluno = new Aluno[8];
	float mediaTurma;
	
	void CriarAlunos(){
		for(int i=0;i<8;i++){
			aluno[i] = new Aluno();
		}
	}
}

class Aluno{
	float[] nota = new float[4];
	float media;
}

public class Exercicio11 {
	
	private static Scanner scanner;

	public static void main(String[] args) {
		
		scanner = new Scanner(System.in);
		Turma[] turma = new Turma[3];
		for(int i=0;i<3;i++){
			turma[i] = new Turma();
			turma[i].CriarAlunos();
		}
		
		for(int i=0;i<3;i++){
			for(int j=0;j<8;j++){
				for(int k=0;k<4;k++){
					System.out.println("Turma "+i+" aluno "+j+" nota da disciplina "+k);
					turma[i].aluno[j].nota[k] = scanner.nextFloat();
				}
			}
		}
		
		for(int i=0;i<3;i++){
			for(int j=0;j<8;j++){
				for(int k=0;k<4;k++){
					turma[i].aluno[j].media += turma[i].aluno[j].nota[k];
				}
				turma[i].aluno[j].media /= 4;
				System.out.println("Media aluno "+j+" : "+turma[i].aluno[j].media);
				turma[i].mediaTurma += turma[i].aluno[j].media;
			}
			turma[i].mediaTurma /= 8;
			System.out.println("Media turma "+i+" : "+turma[i].mediaTurma);
		}
	}

}
