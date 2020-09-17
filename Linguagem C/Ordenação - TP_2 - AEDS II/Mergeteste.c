#include<stdio.h>
#include<stdlib.h>

#define MAXTAM 200000

typedef int TipoChave;

typedef struct TipoItem {
	TipoChave Chave;
} TipoItem;

typedef int TipoIndice;
typedef TipoItem TipoVetor[MAXTAM];

void  merge ( int p, int q, int r, TipoItem vec[]) 
{
   int i, j, k;
   TipoItem *tmp;
	tmp = (TipoItem*) malloc((r-p) * sizeof(TipoItem));
	if (tmp == NULL) { 
		exit(1);
	}
   i = p; j = q;
   k = 0;

   while (i < q && j < r) {
      if (vec[i].Chave <= vec[j].Chave)  tmp[k++] = vec[i++];
      else  tmp[k++] = vec[j++];
   }
   while (i < q)  tmp[k++] = vec[i++];
   while (j < r)  tmp[k++] = vec[j++];
   for (i = p; i < r; ++i)  vec[i] = tmp[i-p];
   free(tmp);
}

void mergesort( int p, int r, TipoItem vec[])
{
   if (p < r-1) {
      int q = (p + r)/2;
      mergesort( p, q, vec);
      mergesort( q, r, vec);
      merge( p, q, r, vec);
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
	
	mergesort(0,n,A);
	
	for(i=0; i <= n-1; i++){
		fprintf(fp2,"%d\n", A[i].Chave);
	}
	
	fclose(fp);
	fclose(fp2);

	return 0;
}
