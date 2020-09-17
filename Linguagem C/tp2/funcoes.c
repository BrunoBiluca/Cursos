#include "funcoes.h"
//função auxiliar para printar o vetor e a distancia entre o ponto e o ponto anterior
int printvetor(int v[20]){
    int i;    
    for(i=0;i<20;i++){
        printf("%d ",v[i]);
        if(i>0){printf("[%d]",distancias[v[i-1]][v[i]]);}
    }printf("\n ");
return 0;
}
//função auxiliar para printar matriz
int printmatriz(int m[20][20]){
    int i,j;    
    for(i=0;i<20;i++){
        printf("time[%d]:",i);
        for(j=0;j<20;j++){
                 printf("[%d]",m[i][j]);
        }printf("\n");
    }
return 0;
}
//função auxiliar para vizualização da rodada e os jogos com respectivos posições de jogo(obs:utilizada para validar a matriz de jogos detro e fora)
int printrodada(int m[20][20],int jg[20][20]){
int i,j,cont,numero;    
for(numero=0;numero<19;numero++){
	    cont=0;
	    for(i=0;i<20;i++){
	        for(j=i;j<20;j++){
	            if (numero==m[i][j] && i<j ){
				printf("%d-%d %d-%d [%d]-[%d] ",numero+1,cont,i,j,jg[i][j],jg[j][i]);
	            if(jg[i][j]*jg[j][i]<=0){printf("valida\n");}
	            else{printf("invalida");}
	            ;cont++ ;}
	        }
	     }
	 }
}
//funcão utilizada para criar a matriz de tabela de jogos
int poligonos(int v[20],int m[20][20]){
    int i,rodada;
    m[19][19]=-1;         //Onde m é a matriz com as rodadas
    for(rodada=0;rodada<19;rodada++){//19 rodadas do campeonato
        m[rodada][rodada]=-1;//flag das linhas centrais das matrizes
        m[v[19]][v[rodada]]=rodada;m[v[rodada]][v[19]]=rodada;//assosciação do time fora do poligono a sequencia interna do poligono
        for(i=1;i<10;i++){
            m[v[(rodada+i)%19]][v[(rodada+19-i)%19]]=rodada;
            m[v[(rodada+19-i)%19]][v[(rodada+i)%19]]=rodada;//associação do vertice posterior e anterior do poligono em sequencia para os outros 9 jogos sem ser o proposto pelo time primario
        }
    }
}
//função q retorna o numero do tome que torna as ultimas 3 rodadas invalidas
int validar(int m[20][20]){
    int i,j,rodada,retorno=-5;
    for(rodada=0;rodada<19;rodada++){//19 rodadas do campeonato
        for(i=0;i<20;i++){				//percorre a matriz a procura de associação entre rodadas e e distancia 0 entre os pontos
            for(j=i;j<20;j++){
                if((rodada==m[i][j])&&(rodada>15)&& (distancias[i][j]==0)){
                    retorno=m[i][j];
                }
            }
        }
    }
   return retorno;   
}
//printa no arquivo a saida (rodada time_em_casa time_visitante)
int printSaida(int m[20][20],int jg[20][20],int soma,int r){
int i,j,numero;
FILE *arq;    
arq = fopen ("tp2.out", "a");
for(numero=0;numero<19;numero++){
	    for(i=0;i<20;i++){
	        for(j=0;j<i;j++){
	            if (numero==m[i][j]){
					if(r==0){if(jg[i][j]<0){fprintf(arq,"%d %d %d\n",numero+1+soma,i+1,j+1);}//inversao de escrita caso qdo o time joga fora e dentro
							if(jg[i][j]>0){fprintf(arq,"%d %d %d\n",numero+1+soma,j+1,i+1);}
						}
						else{if(jg[i][j]>0){fprintf(arq,"%d %d %d\n",numero+1+soma,i+1,j+1);}
							if(jg[i][j]<0){fprintf(arq,"%d %d %d\n",numero+1+soma,j+1,i+1);}
						}
				}
	        }
	     }
	 }
}


