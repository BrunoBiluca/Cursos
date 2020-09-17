#include<stdio.h>
#include<stdlib.h>

int main(){

	int i,j;
	char num[2];
	int a[20][20];
	long int MaiorMult = 0, mult;
	FILE *file;
	
	file = fopen("Entrada.txt","r");
	
	for(i=0;i<=19;i++){
		for(j=0;j<=18;j++){
				fscanf("%c",&num[0]);
				fscanf("%c ",&num[1]);
				//num = getc(file);
				a[i][j] = ((int)atoi(num[2]))*10+(int)atoi(num[2]);
				printf("%d\n", a[i][j]);
			}
			fscanf("%c",&num[0]);
			fscanf("%c\n",&num[1]);
			//num = getc(file);
			a[i][j] = ((int)atoi(num[2]))*10+(int)atoi(num[2]);
		}
	
	//Verificar na horizontal de esquerda para direita
	for(i=0;i<=19;i++){
		for(j=0;j<=16;j++){
			mult = a[i][j]*a[i][j+1]*a[i][j+2]*a[i][j+3];
			if(mult > MaiorMult){
				MaiorMult = mult;
			}
		}
	}
	
	//Verificar na horizontal de direita para esquerda

	//Verificar na vertical de cima para baixo
	for(j=0;j<=19;j++){
		for(i=0;i<=16;i++){
			mult = a[i][j]*a[i+1][j]*a[i+2][j]*a[i+3][j];
			if(mult > MaiorMult){
				MaiorMult = mult;
			}
		}
	}
	
	//Verificar na vertical de baixo para cima

	//Verificar na diagonal direita
	for(i=0;i<=16;i++){
		for(j=0;j<=16;j++){
			mult = a[i][j]*a[i+1][j+1]*a[i+2][j+2]*a[i+3][j+3];
			if(mult > MaiorMult){
				MaiorMult = mult;
			}
		}
	}

	//Verificar na diagonal esquerda
	for(i=19;i<=3;i--){
		for(j=19;j<=3;j--){
			mult = a[i][j]*a[i-1][j-1]*a[i-2][j-2]*a[i-3][j-3];
			if(mult > MaiorMult){
				MaiorMult = mult;
			}
		}
	}
	printf("%ld\n", MaiorMult);
	close(file);
	return 0;
}
