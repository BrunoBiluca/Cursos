/***************************************************************************************
 * 
 * 			SelectionSort 
 * 			Autor: Bruno, Liusley, Michael
 * 			
 * 			O SelectionSort procura a menor chave e a coloca na
 * 			primeira posição, e assim adiante. Para arquivos com registros grandes usamos 
 * 			dois vetores auxiliares, um para índices e outro para as chaves,
 * 			dessa forma a ordenação ocorre da mesma forma que para 
 * 			entradas com registros pequenos, porém o vetor organizado 
 * 			é o vetor de índices. 
 * 
 * ************************************************************************************/


#include<stdio.h>
#include<stdlib.h>

/* ****************************************************************
 * 
 * 					REGISTROS
 * 
 * ***************************************************************/

#define MAXTAM 200000

typedef int TipoChave;

typedef struct TipoItem {
	TipoChave Chave;
} TipoItem;

typedef struct TipoItem2 {
	TipoChave Chave2;
	int conteudo[50][50];
} TipoItem2;

typedef struct TipoIndice{
		int indice;
} TipoIndice;
typedef TipoItem TipoVetor[MAXTAM];
typedef TipoItem2 TipoVetor2[MAXTAM]; 
typedef TipoIndice VetorIndices[MAXTAM];

/* ****************************************************************
 * 
 * 					FUNÇÔES
 * 
 * ***************************************************************/

void selecao(TipoItem A[], int n){
	int i, j, min;
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

void selecao2(TipoItem A2[], VetorIndices Ind , int n){
	int i, j, min, x;
	TipoItem y;
	for (i = 0; i <= n - 1; i++){
		min = i;
		for (j = i+1; j <= n; j++){
				if (A2[j].Chave < A2[min].Chave){
						min = j;
				}
		}
		x = Ind[min].indice;
		Ind[min].indice = Ind[i].indice;
		Ind[i].indice = x;
		y = A2[min];
		A2[min] = A2[i];
		A2[i] = y;
	}
}

double tempo()
{
	struct timeval tv;
	gettimeofday(&tv,0);
	return tv.tv_sec + tv.tv_usec/1e6;
}   

void MenuPrincipal()
{	
		printf("---------------------- MENU -----------------------------\n");
		printf("------------------- 1) n = 20 -----------------------------\n");
		printf("------------------- 2) n = 500 -----------------------------\n");
		printf("------------------- 3) n = 5000 -----------------------------\n");
		printf("------------------- 4) n = 10000 -----------------------------\n");
		printf("------------------- 5) n = 200000 -----------------------------\n");
		printf("------------------- 0) Sair -----------------------------------\n");	
}

void MenuSecundario()
{
		printf("---------------------- MENU -----------------------------\n");
		printf("------------------- 1) Pequeno -----------------------------\n");
		printf("------------------- 2) Grande  -----------------------------\n");
}

void MenuTres()
{
		printf("---------------------- MENU -----------------------------\n");
		printf("------------------- 1) Crescente -----------------------------\n");
		printf("------------------- 2) Decrescente  -----------------------------\n");
		printf("------------------- 3) Aleatório  -----------------------------\n");
}

/* ****************************************************************
 * 
 * 					PRINCIPAL
 * 
 * ***************************************************************/


int main(){

	double inicio, fim; 
	
	TipoVetor A,A_AUX;
	TipoVetor2 A2;
	VetorIndices Indices;
	int n, i , l , c;
	int opcao, opcao2, opcao3;
	
	FILE *fp;
	FILE *fp2;
	
	do{
		
		MenuPrincipal();
		scanf("%d", &opcao);
		
		switch(opcao) {
			case 0:{
				break;
			}
			case 1:{

				MenuSecundario();
				scanf("%d", &opcao2);
				inicio = tempo();		
				
				switch(opcao2) {
					case 1:{
						
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n20_peq_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n20_peq_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n20_peq_rand.txt","r");
								break;
							}
						}		
						fp2 = fopen("Saida_n20.txt","w");	
						
						n = 19;
						for(i = 0;i<= n; i++) {
							fscanf(fp, "\n%d\n", &A[i].Chave);
						}
						
						selecao(A , n);

						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A[i].Chave);
						}

						fclose(fp);
						fclose(fp2);
						break;
					}
					case 2:{
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n20_gran_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n20_gran_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n20_gran_rand.txt","r");
								break;
							}
						}
						fp2 = fopen("Saida_n20.txt","w");	
						n = 19;
						for(i = 0;i<= n; i++) {
							Indices[i].indice = i;
							fscanf(fp, "\n%d\n", &A2[i].Chave2);
							A_AUX[i].Chave = A2[i].Chave2;
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fscanf(fp, "%d ", &A2[i].conteudo[l][c]);
								}
							}
						}

						selecao2(A_AUX, Indices , n);
	
						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A2[Indices[i].indice].Chave2);
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fprintf(fp2, "%d ", A2[Indices[i].indice].conteudo[l][c]);
								}
							}
						}
	
						fclose(fp);
						fclose(fp2);
						break;
					}	
				}
				break;
			}	
			case 2:{		
				MenuSecundario();
				scanf("%d", &opcao2);
				inicio = tempo();		
				
				switch(opcao2) {
					case 1:{
						
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n500_peq_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n500_peq_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n500_peq_rand.txt","r");
								break;
							}
						}		
						fp2 = fopen("Saida_n500.txt","w");
						n = 499;
						for(i = 0;i<= n; i++) {
							fscanf(fp, "\n%d\n", &A[i].Chave);
						}
							selecao(A , n);

						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A[i].Chave);
						}

						fclose(fp);
						fclose(fp2);
						break;
					}
					case 2:{
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n500_gran_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n500_gran_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n500_gran_rand.txt","r");
								break;
							}
						}
						fp2 = fopen("Saida_n500.txt","w");	
						n = 499;
						for(i = 0;i<= n; i++) {
							Indices[i].indice = i;
							fscanf(fp, "\n%d\n", &A2[i].Chave2);
							A_AUX[i].Chave = A2[i].Chave2;
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fscanf(fp, "%d ", &A2[i].conteudo[l][c]);
								}
							}
						}

						selecao2(A_AUX, Indices , n);
	
						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A2[Indices[i].indice].Chave2);
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fprintf(fp2, "%d ", A2[Indices[i].indice].conteudo[l][c]);
								}
							}
						}
	
						fclose(fp);
						fclose(fp2);
						break;
					}	
				}
				break;

			}	
			case 3:{						
				MenuSecundario();
				scanf("%d", &opcao2);
				inicio = tempo();		
				
				switch(opcao2) {
					case 1:{
						
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n5000_peq_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n5000_peq_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n5000_peq_rand.txt","r");
								break;
							}
						}		
						fp2 = fopen("Saida_n5000.txt","w");
						n = 4999;
						for(i = 0;i<= n; i++) {
							fscanf(fp, "\n%d\n", &A[i].Chave);
						}
							selecao(A , n);

						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A[i].Chave);
						}

						fclose(fp);
						fclose(fp2);
						break;
					}
					case 2:{
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n5000_gran_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n5000_gran_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n5000_gran_rand.txt","r");
								break;
							}
						}
						fp2 = fopen("Saida_n20.txt","w");	
						n = 4999;
						for(i = 0;i<= n; i++) {
							Indices[i].indice = i;
							fscanf(fp, "\n%d\n", &A2[i].Chave2);
							A_AUX[i].Chave = A2[i].Chave2;
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fscanf(fp, "%d ", &A2[i].conteudo[l][c]);
								}
							}
						}

						selecao2(A_AUX, Indices , n);
	
						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A2[Indices[i].indice].Chave2);
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fprintf(fp2, "%d ", A2[Indices[i].indice].conteudo[l][c]);
								}
							}
						}
	
						fclose(fp);
						fclose(fp2);
						break;
					}	
				}
				break;
			}	
			case 4:{
				MenuSecundario();
				scanf("%d", &opcao2);
				
				switch(opcao2) {
					case 1:{
						
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n10000_peq_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n10000_peq_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n10000_peq_rand.txt","r");
								break;
							}
						}		
						fp2 = fopen("Saida_n10000.txt","w");	
						
						n = 9999;
						for(i = 0;i<= n; i++) {
							fscanf(fp, "\n%d\n", &A[i].Chave);
						}
							selecao(A , n);

						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A[i].Chave);
						}

						fclose(fp);
						fclose(fp2);
						break;
					}
					case 2:{
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n10000_gran_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n10000_gran_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n10000_gran_rand.txt","r");
								break;
							}
						}
						fp2 = fopen("Saida_n20.txt","w");	
						n = 9999;
						for(i = 0;i<= n; i++) {
							Indices[i].indice = i;
							fscanf(fp, "\n%d\n", &A2[i].Chave2);
							A_AUX[i].Chave = A2[i].Chave2;
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fscanf(fp, "%d ", &A2[i].conteudo[l][c]);
								}
							}
						}

						selecao2(A_AUX, Indices , n);
	
						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A2[Indices[i].indice].Chave2);
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fprintf(fp2, "%d ", A2[Indices[i].indice].conteudo[l][c]);
								}
							}
						}
	
						fclose(fp);
						fclose(fp2);
						break;
					}	
				}
				break;
			}	
			case 5:{
				MenuSecundario();
				scanf("%d", &opcao2);
				inicio = tempo();		
				
				switch(opcao2) {
					case 1:{
						
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n200000_peq_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n200000_peq_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n200000_peq_rand.txt","r");
								break;
							}
						}		
						fp2 = fopen("Saida_n200000.txt","w");
						n = 199999;
						for(i = 0;i<= n; i++) {
							fscanf(fp, "\n%d\n", &A[i].Chave);
						}
							selecao(A , n);

						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A[i].Chave);
						}

						fclose(fp);
						fclose(fp2);
						break;
					}
					case 2:{
						MenuTres();
						scanf("%d", &opcao3);
						inicio = tempo();		
						
						switch(opcao3){
							case 1:{						
								fp = fopen("Entrada_n200000_gran_cres.txt","r");
								break;
							}
							case 2:{						
								fp = fopen("Entrada_n200000_gran_decr.txt","r");
								break;
							}
							case 3:{						
								fp = fopen("Entrada_n200000_gran_rand.txt","r");
								break;
							}
						}
						fp2 = fopen("Saida_n200000.txt","w");	
						n = 19;
						for(i = 0;i<= n; i++) {
							Indices[i].indice = i;
							fscanf(fp, "\n%d\n", &A2[i].Chave2);
							A_AUX[i].Chave = A2[i].Chave2;
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fscanf(fp, "%d ", &A2[i].conteudo[l][c]);
								}
							}
						}

						selecao2(A_AUX, Indices , n);
	
						for(i=0; i <= n; i++){
							fprintf(fp2,"\n%d\n", A2[Indices[i].indice].Chave2);
							for(l = 0; l<=50; l++){
								for (c = 0; c<=50; c++){
									fprintf(fp2, "%d ", A2[Indices[i].indice].conteudo[l][c]);
								}
							}
						}
	
						fclose(fp);
						fclose(fp2);
						break;
					}	
				}
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
