#include<stdio.h>
#include<stdlib.h>

#define MAXTAM 200000

typedef int TipoChave;

typedef struct TipoItem {
	TipoChave Chave;
} TipoItem;

typedef int TipoIndice;
typedef TipoItem TipoVetor[MAXTAM + 1];


void refazer(TipoIndice esq, TipoIndice dir, TipoVetor a) {
	TipoIndice i = esq;
	TipoIndice j;
	TipoItem x;
	j = i * 2;
	x = a[i];
	while (j <= dir) {
		if (j < dir) {
			if (a[j].Chave < a[j+1].Chave) j++;
		}
		if (x.Chave >= a[j].Chave) break;
		a[i] = a[j];
		i = j; j = i * 2;
	}
	a[i] = x;
}

void construir(TipoVetor a, int *n) {
	TipoIndice esq;
	esq = *n / 2 + 1;
	while (esq > 1) {
		esq--;
		refazer(esq, *n, a);
	}
}

void heapsort(TipoVetor a, TipoIndice *n) {
	TipoIndice esq, dir;
	TipoItem x;
	construir(a, n);
	esq = 1; 
	dir = *n;
	while (dir > 1) {
	
	x = a[1];	
	a[1] = a[dir];
	a[dir] = x;
	dir--;
	refazer(esq, dir, a);
	}
}


int main(){

	TipoVetor A;
	TipoIndice n, t, i;
	
	FILE *fp;
	FILE *fp2;

	fp = fopen("Entrada.txt","r");
	fp2 = fopen("Saida.txt","w");

	n=0;
	while (!feof(fp)){
		fscanf(fp, "%d\n", &A[n].Chave);
		n++;
	}
	
	t=n;
	
	heapsort( A, &t);
	
	for(i=0; i <= n -1; i++){
		fprintf(fp2,"%d\n", A[i].Chave);
	}
	
	fclose(fp);
	fclose(fp2);

	return 0;
}
