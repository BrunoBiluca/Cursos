#include<stdio.h>
#include<stdlib.h>

int main(){
	
	int prev1, prev2, num,sum;
	
	prev1 = 1;
	prev2 = 2;
	sum = 2;
	do{
		num = prev1 + prev2;
		if(num % 2 == 0){
			sum = sum + num;	
		}
		prev1 = prev2;
		prev2 = num;		
	}while((prev1+prev2)<=4000000);
	
	printf("%d\n", sum);
	return 0;
}
