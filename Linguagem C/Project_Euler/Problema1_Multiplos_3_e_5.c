#include<stdio.h>
#include<stdlib.h>

int main(){
	
	int i, sum;
	
	sum = 0;
	
	for(i=1;i<1000;i++){
		if( i % 3 == 0 || i % 5 == 0){
			sum = sum + i;
		}
	}
	
	printf("%d\n", sum);
	return 0;
}
