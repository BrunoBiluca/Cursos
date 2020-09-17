#include<stdio.h>

int main(){
	
	int i;
	int sum_quadrados, quadrado_sum;
	
	sum_quadrados = 0;
	quadrado_sum = 0;
	
	for(i=1; i<=100;i++){
		sum_quadrados = sum_quadrados + i*i;
		quadrado_sum = quadrado_sum + i;
	}
	quadrado_sum = quadrado_sum*quadrado_sum;
	
	printf("%d\n", quadrado_sum - sum_quadrados);
	
}
