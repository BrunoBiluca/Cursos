#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/time.h>

#include "triangulos.h"
#include "funcoes.h"

int main(int argc, char** argv) {
        
	int tamanho = 20; 		//LINHAS E COLUNAS DA MATRIZ(+1)
	int i, j;
        FILE *arq,*arq2;
        srand(time(NULL));
	// ALOCAÇÃO DINAMICA DA MATRIZ
	distancias = (int**)calloc(tamanho, sizeof(int*)); // LINHAS
	for (i = 0; i < tamanho; i++) {
		distancias[i] = (int*)calloc(tamanho, sizeof(int)); // COLUNAS
	}

	// INICIALIZAÇÃO DA MATRIZ
	for (i = 0; i < tamanho; i++) {		
		for (j = 0; j < tamanho; j++) {
			distancias[i][j] = 0;
		}
	}
       //leitura do arquivo para a matriz
       if(argc>2){
		   arq = fopen (argv[2], "r");
				for(i=0;i<tamanho;i++){
					for(j=0;j<tamanho;j++){
						fscanf(arq, "%d",&distancias[i][j]);
						if(i==j){j=tamanho;}                    
					}
				}
			}
	   else{printf("ERRO!arquivo de entrada nao definido!\n");}
       arq2 = fopen ("tp2.out", "w");
        //espelhamento da matriz(nao nescessario)
        for(i=0;i<tamanho;i++){
                for(j=0;j<tamanho;j++){
                    if(i>j){distancias[j][i]=distancias[i][j];}                    
                }
       }
	//tratamento das opções de entrada por argumentos
	if(argc==3){
		printf("melhor heuristica\n");triangulos();}
	else if(argc==5 && !argv[4][1]){
			if(argv[4][0]=='1'){printf("Heuristica 1-\n");triangulos();}
			if(argv[4][0]=='2'){printf("Heuristica 2-\n");grasp();}
	}
	else{
			printf("formato de entrada invalido(./tp2 -i [arquivo de entrada] -h [heuristica/opcional])\n");}
        
   free(distancias);
	
    
    return 0;
}
