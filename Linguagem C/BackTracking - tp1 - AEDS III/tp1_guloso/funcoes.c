#include "funcoes.h"
#include "backtraking.h"

// Função para receber o valor passado no terminal
int get(char l[],char posicao){
	int i,retorno;
	retorno=-1;
	for(i=0;i<7;i++){
		if(posicao==l[i]){
			retorno=i;
			break;
		}
	}
	return retorno;
}

// Salva no arquivo as jogadas
int salvar(int l1,int c1,int l2,int c2){
char l[]="ABCDEFG";
char c[]="1234567";

FILE *arq;
arq=fopen("tp1.out","a");
fprintf(arq,"%c%c %c%c\n",l[l1],c[c1],l[l2],c[c2]);
fclose(arq);
return 0;

}

// Reseta o arquivo existente
int clear(){
FILE *arq;
arq=fopen("tp1.out","w");
fclose(arq);

return 0;
}
//Verifica a densidade de cada pino do tabuleiro
//Uma peça é considerada isolada quando não existe nenhuma outra peça diretamente vizinha
int densidade(){
	int a,b,c,d;
	int densidade;
	int densidade_menor = 100;
	for(c=0;c<7;c++){
		for(d=0;d<7;d++){			
			if(tabuleiro[c][d] == 'o'){
				densidade = 0;
				for(a=-1;a<=1;a++){
					for(b=-1;b<=1;b++){
						if((c+a >= 0 && c+a < 7)&&(d+b >= 0 && d+b < 7)){
							if(tabuleiro[c+a][d+b] == 'o'){
								densidade++;
							}
						}
					}
				}
				//printf("%d\n",densidade);
				if(densidade < densidade_menor){
					densidade_menor = densidade;
				}
			}
		}
	}	
	return densidade_menor;
}

// Escolhe a posível melhor rota para uma determinada posição de início
// Tenta consentar as peças para o lugar do buraco
int girar(char l,char c){

	 if(((l=='A')&&(c=='3'))||((l=='C')&&(c=='1'))||((l=='D')&&(c=='1'))){
		 x[0]=1;x[1]=0;x[2]=-1;x[3]=0;
		 y[0]=0;y[1]=1;y[2]=0;y[3]=-1;
		 }
	else if(((l=='D')&&(c=='4'))||((l=='D')&&(c=='5'))||((l=='D')&&(c=='6'))){
		 x[0]=1;x[1]=0;x[2]=-1;x[3]=0;
		 y[0]=0;y[1]=-1;y[2]=0;y[3]=1;
		 }
	else if(((l=='A')&&(c=='4'))||((l=='B')&&(c=='4'))||((l=='B')&&(c=='5'))||((l=='C')&&(c=='4'))||((l=='C')&&(c=='5'))||((l=='C')&&(c=='2'))
	||((l=='B')&&(c=='7'))||((l=='F')&&(c=='4'))||((l=='G')&&(c=='4'))){
		 x[0]=0;x[1]=0;x[2]=1;x[3]=-1;
		 y[0]=-1;y[1]=1;y[2]=0;y[3]=0;
		 }
	else if(((l=='A')&&(c=='5'))||((l=='C')&&(c=='3'))||((l=='E')&&(c=='3'))||((l=='F')&&(c=='3'))){
		 x[0]=1;x[1]=-1;x[2]=0;x[3]=0;
		 y[0]=0;y[1]=0;y[2]=-1;y[3]=1;
		 }
	else if(((l=='B')&&(c=='3'))||((l=='D')&&(c=='2'))){
		 x[0]=-1;x[1]=0;x[2]=1;x[3]=0;
		 y[0]=0;y[1]=-1;y[2]=0;y[3]=1;
		 }
	else if(((l=='C')&&(c=='6'))||((l=='E')&&(c=='1'))||((l=='E')&&(c=='2'))||((l=='E')&&(c=='4'))||((l=='E')&&(c=='5'))||((l=='E')&&(c=='6'))
	||((l=='E')&&(c=='7'))||((l=='G')&&(c=='3'))||((l=='G')&&(c=='5'))){
		 x[0]=0;x[1]=1;x[2]=0;x[3]=-1;
		 y[0]=1;y[1]=0;y[2]=-1;y[3]=0;
		 }
	else if((l=='D')&&(c=='3')){
		 x[0]=1;x[1]=0;x[2]=0;x[3]=-1;
		 y[0]=0;y[1]=1;y[2]=-1;y[3]=0;
		 }
	else if((l=='F')&&(c=='5')){
		 x[0]=0;x[1]=-1;x[2]=1;x[3]=0;
		 y[0]=1;y[1]=0;y[2]=0;y[3]=-1;
		 }
	else {
		x[0]=0;x[1]=-1;x[2]=1;x[3]=0;
		y[0]=1;y[1]=0;y[2]=0;y[3]=-1;
		 }
	return 0;
 }
