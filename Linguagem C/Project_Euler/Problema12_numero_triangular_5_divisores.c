#include<stdio.h>

int main(){
	int i,j, cont_primos;
	long int num;
	
	num = 1;
	for(i=2;i<=20000;i++){
		cont_primos = 2;
		num = num + i;
		for(j=2;j<(num+1)/2;j++){
			if(num % j == 0){cont_primos++;}
			if(cont_primos >= 500){
				printf("%ld\n", num);
				break;
			}
		}
		if(cont_primos >= 500){
			break;
		}
	}
	return 0;
}
