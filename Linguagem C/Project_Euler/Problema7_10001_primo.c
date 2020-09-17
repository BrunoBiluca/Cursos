#include<stdio.h>
#include<math.h>

int main(){
	
	long int i, j;
	int cont_primos, quant_primos = 0 ;
	
	for(i=2;i<=1000000000;i++){
			cont_primos = 1;
			for(j=1;j<=sqrt(i);j++){
				if(i % j  == 0){
					cont_primos++;
				}
			}
			if(cont_primos <= 2){quant_primos++;}
			if(quant_primos == 10001){break;}
		}
	
	printf("%ld\n", i);
	
	return 0;
}
