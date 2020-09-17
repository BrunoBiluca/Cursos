#include <iostream>
#include <map>
#include <vector>
#include <algorithm>
#include <string>
#include <limits>
using namespace std;

int main(int argc, char const *argv[]){
	
	map<string, double> pares;

	pares.insert(pair<string, double>("a", 100));
	pares.insert(pair<string, double>("b", 90));
	pares.insert(pair<string, double>("c", 40));
	pares.insert(pair<string, double>("a", 80));
	pares.insert(pair<string, double>("c", 60));

	//cout << "Tamanho é: " << pares.size() << "\n";

	vector<string> nomes;

	for(map<string, double>::iterator it = pares.begin(); it != pares.end(); ++it){
		if(find(nomes.begin(), nomes.end(), it->first) == nomes.end()){
			nomes.push_back(it->first);
		}
	}

	// for(vector<string>::iterator iv = nomes.begin(); iv != nomes.end(); ++iv){
	// 	cout << *iv << " \n";
	// }

	for(map<string, double>::iterator it = pares.begin(); it != pares.end(); ++it){
		cout << it->first << " " << it->second << endl;
	}

	// double soma = 0;
	// int quant = 0;
	// double media = 0;
	// string nome;
	// for(vector<string>::iterator iv = nomes.begin(); iv != nomes.end(); ++iv){
	// 	cout << *iv << endl;
	// 	nome = *iv;
	// 	soma = 0;
	// 	quant = 0;
	// 	for(map<string, double>::iterator it = pares.begin(); it != pares.end(); ++it){
	// 		cout << it->first << " " << it->second << endl;
	// 		if(nome.compare(it->first) == 0){
	// 			cout << it->first << " " << it->second << endl;
	// 			soma += it->second;
	// 			quant++;
	// 		}
	// 	}
	// 	media = soma/quant;
	// 	cout << *iv << " soma: " << soma << " media: " << media << "\n";
	// }

	return 0;
}