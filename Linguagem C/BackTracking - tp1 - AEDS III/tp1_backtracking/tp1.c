#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <malloc.h>
#include <sys/time.h>
#include <time.h>
#include "funcoes.h"
#include "guloso.h"
#include "backtraking.h"

int main (int argc, char *argv[]) {
	
	clear(); // Limpa o arquivo com as jogadas

	int tamanho = 7; 		//LINHAS DA MATRIZ
	int tam_matriz = 7;	//COLUNAS DA MATRIZ
	int i, j;
	char l[]="ABCDEFG";
	char c[]="1234567";	
	int q0 = 0;
	double ti,tf,tempo; // estruturas para medir
	ti = tf = tempo = 0; // o tempo de execução em que ti = tempo inicial; tf = tempo final
	struct timeval tempo_inicio,tempo_fim; 
	
	gettimeofday(&tempo_inicio,NULL); 
	
	srand(time(NULL));

	// ALOCAÇÃO DINAMICA DA MATRIZ
	tabuleiro = (char**)calloc(tamanho, sizeof(char*)); // LINHAS
	for (i = 0; i < tamanho; i++) {
		tabuleiro[i] = (char*)calloc(tam_matriz, sizeof(char)); // COLUNAS
	}
	

	// INICIALIZAÇÃO DA MATRIZ
	for (i = 0; i < tam_matriz; i++) {		
		for (j = 0; j < tam_matriz; j++) {
			tabuleiro[i][j] = 'x';
			if((i >= 2 && i<= 4) || (j >= 2 && j<= 4)){ 
				tabuleiro[i][j] = 'o';
			}
		}
	}
	
	if (argc == 1){
		i=3;
		j=3;
		girar('D','4');	
	}
	else{
		girar(argv[1][0],argv[1][1]);	
		
		i=get(l,argv[1][0]);
		j=get(c,argv[1][1]);
			
	}
	
	if(tabuleiro[i][j] == 'x'){
		tabuleiro[i][j] = 'x';
	}else{
		tabuleiro[i][j] = ' ';
	}	
	
	
	//joga(i ,j);
		
	backtraking(32,1,&q0);
	
	// IMPRIME
	for (i = 0; i < tamanho; i++) {
		for (j = 0; j < tam_matriz; j++) {
			printf("%c", tabuleiro[i][j]);
			printf(" ");
		}
		printf("\n");
	}	
	
	free(tabuleiro);
	
	gettimeofday(&tempo_fim,NULL); 
	tf = (double)tempo_fim.tv_usec + ((double)tempo_fim.tv_sec * (1000000.0)); 
	ti = (double)tempo_inicio.tv_usec + ((double)tempo_inicio.tv_sec * (1000000.0)); 
	tempo = (tf - ti) / 1000;
	printf("\nTempo gasto em milissegundos %.3f\n\n",tempo);
	
	return 0;
}
