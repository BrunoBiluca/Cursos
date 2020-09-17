#include <stdlib.h>
#include <stdio.h>

#ifndef FUNCOES_H
#define FUNCOES_H

int **distancias;
int **joga,**dist,**rodada,**joga;

int local(int m[20][20],int p[20][19], int j, int *q);

int jogo(int m[20][20],int p[20][19],int l[20][20]);

int medirD(int r[20][20],int j[20][20],int d[20][20]);

int oponente(int rodada,int time,int m[20][20]);

int printvetor(int v[20]);

int printmatriz(int m[20][20]);

int printrodada(int m[20][20],int jg[20][20]);

int poligonos(int v[20],int m[20][20]);

int validar(int m[20][20]);

int printSaida(int m[20][20],int jg[20][20],int soma,int r);

#endif
