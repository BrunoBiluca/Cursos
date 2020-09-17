#include "grasp.h"
#include "funcoes.h"
#include "triangulos.h"

void grasp(){
    int joga[20][19];
    int rodada[20][20],joga2[20][20];
    int distCalculadas[20];
    int i,j,b,x,y;
    long int total, total_min;
    int q0;
    int vp[20];           //Vetor de probabilidade


	for(b=0;b<100;b++){ //cotnador de numero de vezes que o algoritmo repete
		q0 = 0;
		
		for(i=0;i<20;i++){//marca as posições do vetor para ser utilizado
			vp[i] = -1;
		}
		for(x=0;x<20;x++){//marca as posições do matriz para ser utilizada
				for(y=0;y<20;y++){
					rodada[x][y]=-5;
				}
			}
		ordenavetor(vp);//ordena o vetor de forma aleatoria
		for(i=0;i<20;i++){
			for(j=0;j<19;j++){
				joga[i][j]=-1;
			}
			distCalculadas[i] = 0; 
		}
		poligonos(vp,rodada);
		while(validar(rodada)>-4){			//enquanto a matriz rodada nao for valida subistitui o termo que torna esta invalida
			for(i=0;i<20;i++){
					vp[i] = -1;
				}
			ordenavetor(vp); //reordena o vetor caso este seja invalido
				for(x=0;x<20;x++){
					for(y=0;y<20;y++){
					rodada[x][y]=-5;
					}
				}
			poligonos(vp,rodada);
		};
		local(rodada,joga,0,&q0);  
		rodada[0][0] = -1;
			
		total = calculoDistancias(rodada,joga,distCalculadas);
		printf("Total é: %ld\n", total*2);
		if(b == 0){
			total_min = total;
		}
		else if(b>0 && total<total_min){
			total_min = total;
		}
	}
	printf("Total mínimo é: %ld\n", total_min*2);
	jogo(rodada,joga,joga2);
	inverterodada(joga2);
    printSaida(rodada,joga2,19,1);
    printSaida(rodada,joga2,0,0);
} 

long int calculoDistancias(int m[20][20], int p[20][19], int r[20]){
	int i,j,a;
	long int distTotal = 0;
	
	for(i=0;i<20;i++){
		for(j=0;j<19;j++){
			for(a=0;a<20;a++){
				if(m[i][a] == j){
					break;
				}
			}
			
			r[i] = r[i] + 2*distancias[i][a]*p[i][j];
			distTotal +=  2*distancias[i][a]*p[i][j];
		}
	}
	return distTotal;
}
