#include<stdio.h>

int main(){

	int i, cont, maior_cont;
	long int num, maior;
	
	maior_cont = 0;
	maior = 0;
	for(i=13;i<1000000; i++){
		num = i;
		cont = 0;
		while(num!=1){
			cont++;
			if(num % 2 == 0){num = num/2;}
			else{num = 3*num + 1;}		
		}
		if(cont > maior_cont){
			maior_cont = cont;
			maior = i;
		}
	}
	
	printf("%ld\n", maior);

	return 0;
}
