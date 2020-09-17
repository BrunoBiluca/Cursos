#include <stdlib.h>
#include <stdio.h>

#ifndef GRASP_H
#define GRASP_H

void grasp();

int local(int m[20][20],int p[20][19], int j, int *q);

long int calculoDistancias(int m[20][20], int p[20][19], int r[20]);

#endif
