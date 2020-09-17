#include "guloso.h"
#include "funcoes.h"

int joga(int l, int c){
	
	int i,j;
	int valido[] = {0,0,0,0};  	// Verifica a validade da jogada
	int chute;					// Chuta uma opção no momento
	int u,v, u2, v2;			// Analisa próximas posições
	
	int x[] = {-1,1,0,0};		// Casas para ser comparadas em x
	int y[] = {0,0,-1,1};		// Casas para ser comparadas em y

	for(i=0; i<4; i++){			// Verifica a validação das jogadas
			u = l + x[i];
			v = c + y[i];
			u2 = l + 2*x[i];
			v2 = c + 2*y[i];			
			if((u2 >= 0 && u2 <= 6) && (v2 >= 0 && v2 <= 6)){
				if(tabuleiro[l][c] == ' ' && tabuleiro[u][v] == 'o' && tabuleiro[u2][v2] == 'o'){
					valido[i] = 1;		// Jogada válida
				}	
			}
	}

	do{	
		chute = rand()%5;		
		
		if(chute < 4){			// Joga para uma das jogadas válidas
			u = l + x[chute];
			v = c + y[chute];
			u2 = l + 2*x[chute];
			v2 = c + 2*y[chute];			
			if(valido[chute] == 1){
				tabuleiro[l][c] = 'o';
				tabuleiro[u][v] = ' ';
				tabuleiro[u2][v2] = ' ';
				salvar(u2,v2,l,c);
				joga(u, v);
				joga(u2, v2);				
			}
		}
		else{					// Procura uma jogada válida no tabuleiro e joga
			for(i=0;i<7;i++){
				for(j=0;j<7;j++){
					if(i >1 && tabuleiro[i][j] == ' ' && tabuleiro[i-1][j] == 'o' && tabuleiro[i-2][j] == 'o'){
						joga(i, j);
						i = 7;
						break;
					}
					else if(i < 5 && tabuleiro[i][j] == ' ' && tabuleiro[i+1][j] == 'o' && tabuleiro[i+2][j] == 'o'){
						joga(i, j);
						i = 7;
						break;
					}	
					else if(j > 1 && tabuleiro[i][j] == ' ' && tabuleiro[i][j-1] == 'o' && tabuleiro[i][j-2] == 'o'){
						joga(i, j);
						i = 7;
						break;
					}	
					else if(j < 5 && tabuleiro[i][j] == ' ' && tabuleiro[i][j+1] == 'o' && tabuleiro[i][j+2] == 'o'){
						joga(i, j);
						i = 7;
						break;
					}	
				}
			}
			break;					// Se não existem jogadas válidas o loop é quebrado
		}		
	}while(valido[chute] == 0); 	// Acaba quando já jogou ou não existem mais jogadas
	
	
	return 0;
}

