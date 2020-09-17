#include<stdio.h>


int main(){
	int vetor1[6];
	int vetor2[6];
	
	int i, j,k,l,cont, cont2;
	int mult, novo;
	int maior = 0;
	
	for(k=999;k>=100;k--){
		for(l=999;l>=100;l--){
			mult = k*l;
			
			// Contar os dígitos
			cont = 0;
			novo = mult;
			while(novo!=0){
				novo = novo/10;
				cont++;
			}
			
			//Atribuir aos vetores os dígitos
			novo = mult;
			i = cont-1;
			while(i>=0){
				vetor1[i] = novo % 10;
				vetor2[i] = novo % 10;
				novo = novo/10;
				i--;
			}
			
			//Verificar o palindrismo
			i = cont-1;
			j = 0;
			cont2 = 0;
			do{
				if(vetor1[i] == vetor2[j]){
					cont2++;
				}
				i--;
				j++; 				
			}while(i>=0);
			
			if(cont2 == cont && mult > maior){
					maior = mult;
			}
		}
	}
	
	printf("%d\n", maior);
	
	return 0;
}
