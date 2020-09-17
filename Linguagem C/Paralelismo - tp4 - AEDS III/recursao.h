#include<stdlib.h>
#include<stdio.h>
#include<string.h>

#ifndef RECURSAO_H
#define RECURSAO_H

//controle de treads
pthread_t threads[4];
pthread_mutex_t mutex;


//struct matriz

struct pmatriz{
	int **matriz;//endereço da matriz
	int m;//numero maximo de linhas
	int n;//numero maximo de colunas(contagem de m*m caracteres)
	int i;//linha atual
	int j;//coluna atual
	int k;//numero do componente ao qual o elemento pode pertencer	
}pmatriz;


//função marca posição e verifica proximas
void recursao(void *arg);


#endif
