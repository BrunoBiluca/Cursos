#include<stdio.h>


int main(){
	int i,j, cont;
	
	for(i=20; i<=1000000000;i++){
		cont = 0;
		for(j=1;j<=20;j++){
			if(i % j == 0){cont++;}
		}
		if(cont == 20){break;}
	}
	
	printf("%d\n", i);
}
