#include<stdio.h>
#include<stdlib.h>

#define MAXTAM 200000

typedef int TipoIndice ;

typedef struct TipoItem {
	int Chave;
} TipoItem;

typedef TipoItem TipoVetor[MAXTAM];


void refazer(TipoIndice esq, TipoIndice dir, TipoVetor a) {
	TipoIndice i = esq;
	int j;
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

void construir(TipoVetor a, TipoIndice n) {
	TipoIndice esq;
	esq = n / 2 + 1;
	while (esq > 1) {
		esq--;
		refazer(esq, n, a);
	}
}

void heapsort(TipoVetor a, TipoIndice n) {
	TipoIndice esq, dir;
	TipoItem x;
	construir(a, n);
	esq = 1; 
	dir = n;
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
	int n, t, i;
	
	FILE *fp;
	FILE *fp2;

	fp = fopen("Entrada.txt","r");
	fp2 = fopen("Saida.txt","w");

	n=1;
	while (!feof(fp)){
		fscanf(fp, "%d\n", &A[n].Chave);
		n++;
	}
	n--;
	t=n;
	
	heapsort( A, t);
	
	for(i=1; i <= n; i++){
		fprintf(fp2,"%d\n", A[i].Chave);
	}
	
	fclose(fp);
	fclose(fp2);

	return 0;
}
