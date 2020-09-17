#include<stdio.h>
#include<math.h>

int main(){
	
	long long int i, j, n , SumPrimo = 0, cont_primos;
	
	n = 2000000;
	for(i=2;i<=n;i = i + 2){
		cont_primos = 2; 
		for(j=2;j<=sqrt(i);j++){
			if(i % j  == 0){
				cont_primos++;
			}
		}
		if(cont_primos == 2){
			SumPrimo = SumPrimo + i;
		}
	}
	
	printf("%lld\n", SumPrimo);
	
	return 0;
}
