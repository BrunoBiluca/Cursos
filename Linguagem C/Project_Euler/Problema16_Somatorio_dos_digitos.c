#include<stdio.h>
#include<math.h>

int main(){
	
	double num, novo_num;
	int i,sum;
	
	num = pow(2, 1000);
	novo_num = num;
	
	while(novo_num<=0){
		sum = novo_num % 10;
		novo_num = novo_num/10;
	}
	
	printf("%f\n", sum);

	return 0;
}
