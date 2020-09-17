#include "triangulos.h"
#include "grasp.h"
#include "funcoes.h"
//função de backtrack para avaliar jogos em casa ou fora
int local(int m[20][20],int p[20][19], int j, int *q){
	int a,q1, i,num;
	int falha = 0;	
	q1 = *q;
	
	do{				
		for(i=0;i<20;i++){	
			for(a=0;a<20;a++){
					if(m[i][a]==j){
						break;
					}
			}				
			if(j<2 && p[i][j]==-1){
					num = rand()%2;
					p[i][j] = num;
					p[a][j] = 1 - num;
			}
			else if(j>=2 && p[i][j]==-1){
				if(((p[i][j-2]+p[i][j-1])==0 && (p[a][j-2]+p[a][j-1])==0) || ((p[i][j-2]+p[i][j-1])==2 && (p[a][j-2]+p[a][j-1])==2)){
					falha = 1;
					break;
				}
				else if((p[i][j-2]+p[i][j-1])==0 || (p[a][j-2]+p[a][j-1])==2){
					p[i][j] = 1;
					p[a][j] = 0;
				}
				else if((p[i][j-2]+p[i][j-1])==2 || (p[a][j-2]+p[a][j-1])==0){
					p[i][j] = 0;
					p[a][j] = 1;
				}
				else{
					num = rand()%2;
					p[i][j] = num;
					p[a][j] = 1 - num;
				}				
			}
		}					
		if(falha == 0){
			if(j<19){
				local(m,p,j+1,&q1);
				if(q1 == 0){
					for(i=0;i<20;i++){
						p[i][j] = -1;
						p[i][j+1] = -1;
					}
				}
			}					
			else{q1 = 1;}
		}
	}while(q1 == 0 && falha == 0);
	*q = q1;
		
	return 0;
}       
//tranformação aplicada sobre uma matriz binaria de jogos(dentro ou fora) para conseguir uma matriz de maquina de estados. 
int jogo(int m[20][20],int p[20][19],int l[20][20]){
	int j,i,rodada;
	for(rodada=0;rodada<19;rodada++){
		for(i=0;i<20;i++){	
				for(j=0;j<20;j++){
						if(i==j){l[i][j]=-5;}
						if(m[i][j]==rodada){
							if(rodada==0){if(p[i][rodada]==0){l[i][j]=-1;}if(p[i][rodada]==1){l[i][j]=1;}}
							else if(p[i][rodada]==0){l[i][j]=-1;
							if(p[i][rodada-1]==0){l[i][j]=-2;}}
							else if (p[i][rodada]==1){l[i][j]=1;
							if (p[i][rodada-1]==1){l[i][j]=2;}}
					}
			}				
	}
}
}
//mede a distancia avaliando a cidade de partida do time e o ultimo jogo de forma a obter menos gastos.
int medirD(int r[20][20],int jg[20][20],int d[20][20]){
	int i,j,rodada;
	for(rodada=0;rodada<20;rodada++){
		for(i=0;i<20;i++){	
				for(j=0;j<20;j++){
					if(r[i][j]==rodada && rodada==0){ 			//Primeira rodada
							if(jg[i][j]==1){d[i][rodada]=distancias[i][j];}
						}
					else if(r[i][j]==rodada && rodada>0){		//Demais rodadas
							if(jg[i][j]==1){d[i][rodada]=d[i][rodada-1]+distancias[i][oponente(rodada-1,i,r)];}
							else if(jg[i][j]==2){d[i][rodada]=d[i][rodada-1]+distancias[oponente(rodada-1,i,r)][j];}
							else if(jg[i][j]==-1){d[i][rodada]=d[i][rodada-1]+distancias[oponente(rodada-1,i,r)][i];}
							else if(jg[i][j]==-2){d[i][rodada]=d[i][rodada-1];}							
						}
					}
				}
			}
					
	}
	
//dada uma rodada e um time retorna o oponete ao qual o time jogou
int oponente(int rodada,int time,int m[20][20]){
int i,j,retorno=-1;    
	    for(i=0;i<20;i++){
	        for(j=0;j<20;j++){
	            if ((rodada==m[i][j]) && ((time==i) && (i!=j)) ){retorno=j;break;}
	        }
            }
        return retorno;
}		
//ordena o vetor de forma aleatoria
void ordenavetor(int v[20]){
int i,n;
for(i=0;i<20;i++){
		do{
			n=rand()%20;
		}while(nonv(n,v));
		v[i]=n;
	}
}
//avalia se o numero N esta no vetor V
int nonv(int n,int v[20]){
	int i,retorno=0;
	     for(i=0;i<20;i++){
			if(v[i]==n){
				retorno=1;break;
			}
	} 
return retorno;
}

//Pega como primero elemento um daqueles que possua mais posiçoes com distancia 0,apos isso pega as posições com menor distacia
void ordenatriangulo(int v[20]){
	int i;
	v[0]=maisrepete();
	for(i=1;i<20;i++){
		v[i]=getlesserD(v[i-1],v);
	}
}
//retorna a posição com menor distancia e que ainda nao esteja no vetor
int getlesserD(int linha,int v[20]){
	int j,retorno=-1,menor=60000;          
		for(j = 0;j <  20; j++){
			if((distancias[linha][j]<menor)&& !(nonv(j,v))){
					retorno=j;
					menor=distancias[linha][j];
				}
		}
	return retorno;
}

//avalia o time que possui mais times adjacentes(distancia 0)
int maisrepete(){

	int i,mais=-1,retorno=-1;

		for(i=0;i<20;i++){
			if(repete(i)>mais){
					retorno=i;
					mais=repete(i);
				}
		}
		return retorno;
}

//avalia quantos times existem adjacentes(distancia 0)
int repete(int linha){
	int j;
    int cont=0;
		for (j = 0; j < 20; j++) {          
                    if(distancias[linha][j]==0){
                        cont+=1;
                    }
		}
      return cont/2;
}
//caso exista um time cuja as ultimas 3 rodadas sejam invalidas,randoniza um numero e troca este de posição
int swap(int pos,int v[20]){
		int i,aux;
		do{
			aux=rand()%20;
		}while(distancias[aux][pos]==0);
		for(i=0;i<20;i++){
		if(v[i]==pos){
			v[i]=aux;
		}
		else if(v[i]==aux){
			v[i]=pos;
		}
	}
}
//aplica uma transformaçao para obeter a matriz de estados da segunda rodada
int inverterodada(int m[20][20]){
	int i,j;
	for(i=0;i<20;i++){
		for(j=0;j<20;j++){
			if(m[i][j]!=-5){m[i][j]=-m[i][j];}	
		}
	}
}
void triangulos(){
    int joga[20][19],dist[20][20];
    int rodada[20][20],joga2[20][20];
    int cont=0,i,j,q0 = 0;
    int total=0;
    int vp[20];          				 //Vetor de probabilidade
    
    for(i=0;i<20;i++){vp[i]=-5;}		//inicialisa o vetor com -5
	ordenatriangulo(vp);				//aplica a função ordenatriaagulos,obtendo assim um vetor com melhoria de distancias estre os pontos
	poligonos(vp,rodada);				//cria umam atriz de rodadas a partir do vetor de entrada
		
	while(validar(rodada)>-4){			//enquanto a matriz rodada nao for valida subistitui o termo que torna esta invalida
		swap(validar(rodada),vp);
		if(cont%100000==0){				//tratamento para posicionamento invalido de vetores
			for(i=0;i<20;i++){vp[i]=-5;}
			ordenavetor(vp);
			}
		for(i=0;i<20;i++){
			for(j=0;j<20;j++){
				rodada[i][j]=-5;
			}
		}
		poligonos(vp,rodada);
		cont++;
		
	};
	for(i=0;i<20;i++){		//inicializa a matriz joga
		for(j=0;j<19;j++){
			joga[i][j]=-1;
		}
	}    
    local(rodada,joga,0,&q0);	//aplica a função local para obter uma matriz de jogos dentro ou fora de casa
    jogo(rodada,joga,joga2);	//aplica uma transformaçao sobre a matriz joga para obter os mesmos indices usados na matriz rodada
    medirD(rodada,joga2,dist);  //gera uma matriz com calculos de distancias a cada rodada
    for(i=0;i<20;i++){
		total+=dist[i][18];      //soma o total de distancias percoridos de cada time nas ultimas rodadas
	}
	
    printf("total primeira rodada= %d km\n",total);
    
    inverterodada(joga2);		//escreve no arquivo de saida os jogos e ordens
    printSaida(rodada,joga2,19,1);
    medirD(rodada,joga2,dist);
    for(i=0;i<20;i++){
		total+=dist[i][18];
	}
    printf("total segunda rodada= %d km\n",total);   //calcula distancia percorida na segunda rodada
    
    printSaida(rodada,joga2,0,0);
}

		


