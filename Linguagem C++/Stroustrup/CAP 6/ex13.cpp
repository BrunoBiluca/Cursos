/*
	Função de concatenação de duas string no estilo do C
*/

#include <iostream>
#include <cstring>

using namespace std;

char* cat(char* str1, char* str2){

	int tamanho1 = strlen(str1);
	int tamanho2 = strlen(str2); 
	int tamanhoTotal = tamanho1 + tamanho2;

	char* s = new char[tamanhoTotal + 1]; 

	int i = 0;
	int j = 0;
	int k = 0;

	for(i = 0; i < tamanhoTotal; i++){
		if(i < tamanho1){
			s[i] = str1[j];
			j++;
		}else{
			s[i] = str2[k];
			k++;
		}
	}

	return s;
}

int main(int argc, char const *argv[]){
	
	char* string;

	string = cat("asssss", "bs");

	int tamanho = strlen(string);

	cout << string << endl;
	cout << "Tamanho: " << tamanho << endl;

	return 0;
}