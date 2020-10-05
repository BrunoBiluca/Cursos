#include "recursao.h"
//função marca posição e verifica proximas
void recursao(void *arg){
	struct pmatriz *m=(struct pmatriz *)arg;
	struct pmatriz aux;
	//atribuição na posição e chamada de recursão baseada nas posições adjacentes
	pthread_mutex_lock(&mutex);
	m->matriz[m->i][m->j]=m->k;
	pthread_mutex_unlock(&mutex);
	//verifica linha+1	
    if(m->i!=m->m-1 && m->matriz[m->i+1][m->j]==-1){
		aux=*m;
		aux.i=aux.i+1;
		recursao((void *)&aux);
	}
    //verifica linha-1	
	if(m->i!=0 && m->matriz[(m->i)-1][m->j]==-1){
		aux=*m;
		aux.i=aux.i-1;
		recursao((void *)&aux);
	}
    //verifica coluna-1
    if(m->j!=0 && m->matriz[m->i][(m->j)-1]==-1){
		aux=*m;
		aux.j=aux.j-1;
		recursao((void *)&aux);
	}
    //verifica coluna+1
	if(m->j!=m->m-1 && m->matriz[m->i][m->j+1]==-1){
		aux=*m;
		aux.j=aux.j+1;
		recursao((void *)&aux);
	}				
}