/**********************************************************************
 * 
 * O maior mator que determina um número primo é a raiz do número,
 * sendo assim não é necessário testar números maiores que a raiz 
 * do número para verificar se o número é primo.
 * 
 * Para poder usar a função sqrt() é necessário usar -lm no comando de
 * compilação.
 *  
 * *******************************************************************/

#include<stdio.h>
#include<math.h>

int main(){
	
	long long int i, j, n , MaiorPrimo, cont_primos;
	
	//n = 600851475143;
	n = 10;
	for(i=sqrt(n);i>=1;i--){
		cont_primos = 1;
		if(n % i == 0){ 
			for(j=1;j<=sqrt(i);j++){
				if(i % j  == 0){
					cont_primos++;
				}
				if(cont_primos > 2){break;}
			}
			if(cont_primos <= 2){
				MaiorPrimo = i;
				break;
			}
		}
	}
	
	printf("%lld\n", MaiorPrimo);
	
	return 0;
}
