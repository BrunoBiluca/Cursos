#include<stdio.h>
#include<stdlib.h>

#define MAXTAM 20

typedef int TipoChave;

typedef struct TipoItem {
	TipoChave Chave;
} TipoItem;

typedef int TipoIndice;
typedef TipoItem TipoVetor[MAXTAM];

void selecao(TipoItem A[], TipoIndice n){
	TipoIndice i, j, min;
	TipoItem x;
	for (i = 0; i <= n - 1; i++){
		min = i;
		for (j = i+1; j <= n; j++){
				if (A[j].Chave < A[min].Chave){
						min = j;
				}
		}
	x = A[min];
	A[min] = A[i];
	A[i] = x;
	}
}


int main(){

	TipoVetor A;
	TipoIndice n, i;
	
	FILE *fp;
	FILE *fp2;

	fp = fopen("Entrada.txt","r");
	fp2 = fopen("Saida.txt","w");

	n=0;
	while (!feof(fp)){
		fscanf(fp, "%d\n", &A[n].Chave);
		n++;
	}

	selecao(A , n);
	
	for(i=0; i <= n - 1; i++){
		fprintf(fp2,"%d\n", A[i].Chave);
	}
	
	fclose(fp);
	fclose(fp2);

	return 0;
}
