#include "backtraking.h"
#include "funcoes.h"
#include <stdio.h>

int backtraking(int pecas, int buracos, int *q){

	int k,i,j;
	int q1;						// Verificador de parada do backtraking
	int buracos_verif;			// Quantidade de buracos possíveis para jogar
	int densidade_menor;		// Densidade da peça com menos peças próximas
	int u,v, u2, v2;			// Analisa próximas posições
	
	densidade_menor = densidade(); 
	buracos_verif = buracos;
	if(densidade_menor > 1){	// Verifica se tem alguma peça isolada
		for(i=0;i<7;i++){		// Varre o tabuleiro para verificar jogadas
			for(j=0;j<7;j++){	
				if (tabuleiro[i][j] == ' '){	
					buracos_verif--;
					k = 0;
					do{			// Tenta as quatro jogadas possíveis para um ponto
						q1 = *q;
						u = i + x[k];
						v = j + y[k];
						u2 = i + 2*x[k];
						v2 = j + 2*y[k];
						if((u2 >= 0 && u2 < 7) && (v2 >= 0 && v2 < 7)){			
							if(tabuleiro[u][v] == 'o' && tabuleiro[u2][v2] == 'o'){  // Verifica se tem como jogar
								tabuleiro[i][j] = 'o';	tabuleiro[u][v] = ' ';	tabuleiro[u2][v2] = ' ';				
								pecas--;
								buracos++;
								
								if(pecas > 1){				// Verifica a quantidade de peças
									backtraking(pecas,buracos,&q1);
									if(q1 == 0){			// Se voltou e não terminou
												tabuleiro[i][j] = ' ';tabuleiro[u][v] = 'o';tabuleiro[u2][v2] = 'o';
												pecas++;
												buracos--;
									} 
								}else {q1 = 1;}  // Quanto termina
							}
						}
						if(q1==1){	// Salva o arquivo
							salvar(u2,v2,i,j);
						}
						k++;				// Próxima jogada
					}while((k<4) && (q1 == 0));			// quando um dos argumentos for falso o loop é encerrado voltando as recursões
					*q = q1;
					if(buracos_verif < 1 || q1 == 1){
						i = 7;
						j = 7;
					}
				}											
			}
		}
	}
	return 0;
}
