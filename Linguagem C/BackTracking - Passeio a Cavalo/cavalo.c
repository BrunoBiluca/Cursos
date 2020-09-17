#include <stdlib.h>
#include <stdio.h> 

int t[8][8];
int a[8];
int b[8];



int tenta(int i, int x, int y, int *q){
	
	int u,v,k;
	int q1;
		
	k = 0;
	q1 = 0;	
	//printf("%d\n",i);
	do{
		u = x+a[k];v = y + b[k];
		if((u>=0 && u<8)&&(v>=0 && v<8)){
			if(t[u][v] == 0){
				t[u][v] = i;
				if(i<64){
					tenta(i+1,u,v,&q1);
					if (q1 == 0){
						t[u][v] = 0;
					}
				}else{q1 = 1;}
			}
		}
		k++;	
	}while(q1 == 0 && k<8);
	*q = q1;
	return 0;
}


int main(){
	int i,j;
	int q = 0;
	
	a[0] = 2; a[1] = 1; a[2] =-1; a[3] =-2;
	b[0] = 1; b[1] = 2; b[2] = 2; b[3] = 1;
	a[4] = -2; a[5] = -1; a[6] = 1; a[7] = 2;
	b[4] = -1; b[5] = -2; b[6] =-2; b[7] = -1;	
	
	for(i=0;i<8;i++){
		for(j=0;j<8;j++){
			t[i][j] = 0;
		}
	}
	t[1][1] = 1;
	
	tenta(2,1,1,&q);
	
	if(q == 1){
		printf("Solução encontrada");
	}else{printf("Erro");} 
	
	return 0;
	
}
