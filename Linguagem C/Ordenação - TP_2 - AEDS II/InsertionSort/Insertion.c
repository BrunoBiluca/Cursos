#include<stdio.h>
#include<stdlib.h>

#define MAXTAM 200000

typedef int TipoChave;

typedef struct TipoItem {
	TipoChave Chave;
} TipoItem;

typedef int TipoIndice;
typedef TipoItem TipoVetor[MAXTAM+1];

void insercao(TipoVetor A, TipoIndice n) {
	TipoIndice i, j;
	TipoItem x;
	
	for (i = 2; i <= n; i++) {
		x = A[i];
		j = i - 1;
		A[0] = x;
		/* sentinela */
		while (x.Chave < A[j].Chave) {
			A[j+1] = A[j];
			j--;
		}
		A[j+1] = x;
	}
}

double tempo()
{
 struct timeval tv;
 gettimeofday(&tv,0);
 return tv.tv_sec + tv.tv_usec/1e6;
}   

int main(){


	double inicio, fim; 
	
	TipoVetor A;
	TipoIndice n, i;
	int opcao;
	
	FILE *fp;
	FILE *fp2;
	
	do{
		
		printf("---------------------- MENU -----------------------------\n");
		printf("------------------- 1) n = 20 -----------------------------\n");
		printf("------------------- 2) n = 500 -----------------------------\n");
		printf("------------------- 3) n = 5000 -----------------------------\n");
		printf("------------------- 4) n = 10000 -----------------------------\n");
		printf("------------------- 5) n = 200000 -----------------------------\n");
		printf("------------------- 0) Sair -----------------------------------\n");
		scanf("%d",&opcao);
		
		inicio = tempo();		
		
		switch(opcao) {
			case 0:{
			
				break;
			}
			case 1:{
			    
				fp = fopen("Entrada_n20.txt","r");
				fp2 = fopen("Saida_n20.txt","w");

				n = 19;
				for(i = 0;i<= n; i++) {
					fscanf(fp, "%d\n", &A[i].Chave);
				}

				insercao(A,n);
	
				for(i=0; i <= n; i++){
					fprintf(fp2,"%d\n", A[i].Chave);
				}
	
				fclose(fp);
				fclose(fp2);
				
				break;
			}
			case 2:{
			
				n = 499;
				fp = fopen("Entrada_n500.txt","r");
				fp2 = fopen("Saida_n500.txt","w");

				for(i = 0;i<= n; i++) {
					fscanf(fp, "%d\n", &A[i].Chave);
				}

				insercao(A,n);
	
				for(i=0; i <= n - 1; i++){
					fprintf(fp2,"%d\n", A[i].Chave);
				}
	
				fclose(fp);
				fclose(fp2);			
				break;
			}	
			case 3:{
			
				n = 4999;
				fp = fopen("Entrada_n5000.txt","r");
				fp2 = fopen("Saida_n5000.txt","w");

				for(i = 0;i<= n; i++) {
					fscanf(fp, "%d\n", &A[i].Chave);
				}

				insercao(A,n);
	
				for(i=0; i <= n; i++){
					fprintf(fp2,"%d\n", A[i].Chave);
				}
	
				fclose(fp);
				fclose(fp2);

				break;
			}
			case 4:{
			    			
				n = 9999;
				fp = fopen("Entrada_n10000.txt","r");
				fp2 = fopen("Saida_n10000.txt","w");

				for(i = 0;i<= n; i++) {
					fscanf(fp, "%d\n", &A[i].Chave);
				}

				insercao(A,n);
	
				for(i=0; i <= n; i++){
					fprintf(fp2,"%d\n", A[i].Chave);
				}
	
				fclose(fp);
				fclose(fp2);		

				break;
			}
			case 5:{
			
				n = 199999;
				fp = fopen("Entrada_n200000.txt","r");
				fp2 = fopen("Saida_n200000.txt","w");

				for(i = 0;i<= n; i++) {
					fscanf(fp, "%d\n", &A[i].Chave);
				}

				insercao(A,n);
	
				for(i=0; i <= n; i++){
					fprintf(fp2,"%d\n", A[i].Chave);
				}
	
				fclose(fp);
				fclose(fp2);

				break;
			}
			default:{
				printf("Erro no escolha da opcao.\n");
				break;
			}
		}
		
		fim = tempo();
				
		printf("%lf\n", inicio);
		printf("%lf\n", fim);
		printf("%lf\n", fim - inicio);		
		
	}while(opcao!=0);
	
	return 0;
}
