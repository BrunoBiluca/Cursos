#include<stdio.h>

int main(){
	int a, b, c;
	
	for(a=1; a<=1000;a++){
		for(b=a+1;b<=1000;b++){
			c = 1000 - b - a;
			if((a*a + b*b == c*c) && (a + b + c == 1000)){printf("%d\n", a*b*c);}
		}
	}
	
	
}
