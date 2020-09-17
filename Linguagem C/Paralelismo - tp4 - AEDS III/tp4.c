#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/time.h>
#include <time.h>

#include <pthread.h>
#include "recursao.h"

int main(int argc, char *argv[]){
	int c;
	
	int i,j,n=0,m=0,k=0,t,flag=0,p;
	
	struct pmatriz pm[4];
	pthread_mutex_init(&mutex, NULL);
	double ti,tf,tempo; // estruturas para medir
	ti = tf = tempo = 0; // o tempo de execução em que ti = tempo inicial; tf = tempo final
	struct timeval tempo_inicio,tempo_fim; 
	

	
	int **matriz;
	FILE *file;
	
	if((strcmp(argv[1],"-i")==0) && (strcmp(argv[3],"-t")==0)){
		//escolha de heuristica
		if ((file = fopen(argv[2],"r")) == NULL){
			printf("arquivo nao encontrado!!!\n");
			flag=1;
		}
		if(strcmp(argv[4],"1")==0){
			p=1;
		}
		else if(strcmp(argv[4],"2")==0){
			p=2;
		}
		else if(strcmp(argv[4],"3")==0){
			p=3;
		}
		else if(strcmp(argv[4],"4")==0){
			p=4;
		}
		else{
			printf("\nEescolha um valor de processo valido!!!\n");
			flag=1;
		}
	}
	else{
		flag=1;
	}
	if (flag==1){
		printf("formato de entrada invalido\n./tp4 -i [arquivo de entrada] -t [numero de threads]\n");
		return 1;
	}
	else{
	//analiza numero de linhas e colunas da matriz e numero de elementos para alocação da matriz(nescecidade de melhoria para falta de caracteres \n)
	while (c!='\n'){
		c=getc(file);
		if((c=='0')||(c=='1')){
			m++;
		}
	}
	n=m*m;
	printf("arquivo-%s     \n nº de linhas e colunas=%d     \n nº de caracteres:%d\nNº de threads=%s",argv[2],m,n,argv[4]);
	file = fopen(argv[2],"r");
	//alocação dinamica da matriz
	matriz = (int **) calloc (m,sizeof(int *));
	for (j=0;j<m;j++){
		matriz[j] = (int *) calloc (m,sizeof(int));
	}
	//leitura da matriz e adição de flags
	for(i=0;i<m;i++){
		for(j=0;j<m;j++){
			fscanf(file,"%d",&matriz[i][j]);
			matriz[i][j]=matriz[i][j]*-1;
		}
	}
	//printa matriz
	/*for(i=0;i<m;i++){
		for(j=0;j<m;j++){
			printf("%d     ",matriz[i][j]);
		}
			printf("\n");
	}*/
	gettimeofday(&tempo_inicio,NULL); 
	pm[0].matriz=pm[1].matriz=pm[2].matriz=pm[3].matriz=matriz;
    pm[0].m=pm[1].m=pm[2].m=pm[3].m=m;
    pm[0].n=pm[1].n=pm[2].n=pm[3].n=m;//erro por n avaliar numero de elementos(melhorar leitura de arquivo e avaliação de posições)
	for(i=0;i<m;i++){
		for(j=0;j<m;j++){
			k++;
			if(matriz[i][j]==-1){
				matriz[i][j]=k;
				pm[0].k=pm[1].k=pm[2].k=pm[3].k=k;		
				if(i!=m-1){
					 if(matriz[i+1][j]==-1){
						pm[0].i=i+1;
						pm[0].j=j;
						pthread_create(&(threads[0%p]), NULL,(void *)recursao,&pm[0]);
					}
				}
				if(j!=m-1){
					if(matriz[i][j+1]==-1){;
						pm[1].i=i;
						pm[1].j=j+1;
						pthread_create(&(threads[1%p]), NULL,(void *)recursao,&pm[1]);
					}
				}
				if(i!=0){
						if (matriz[i-1][j]==-1){
							pm[2].i=i-1;
							pm[2].j=j;
							pthread_create(&(threads[2%p]), NULL,(void *)recursao,&pm[2]);
					}
				}
				if(j!=0){
					if(matriz[i][j-1]==-1){
						pm[3].i=i;
						pm[3].j=j-1;
						pthread_create(&(threads[3%p]), NULL,(void *)recursao,&pm[3]);
					}
				}
				for(t=0; t<4; t++) {
					pthread_join(threads[t], NULL);
				}
			}
		}		
	}
	k=1;
	file=fopen("tp4.out","w+");
	for(i=0;i<m;i++){
		for(j=0;j<m;j++){
				fprintf(file,"%d  ",matriz[i][j]);
			k++;
			}
		fprintf(file,"\n");
	}
	}
	free(matriz);
	gettimeofday(&tempo_fim,NULL); 
	tf = (double)tempo_fim.tv_usec + ((double)tempo_fim.tv_sec * (1000000.0)); 
	ti = (double)tempo_inicio.tv_usec + ((double)tempo_inicio.tv_sec * (1000000.0)); 
	tempo = (tf - ti) / 1000;
	printf("\nTempo gasto em milissegundos %.3f\n\n",tempo);
	return 0;
}
