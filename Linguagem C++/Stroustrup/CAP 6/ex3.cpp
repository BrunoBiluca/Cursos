#include <iostream>
#include <string>
#include <vector>
#include <map>
#include <algorithm>

using namespace std;

/*
	É criado um map para a indexação de cada nome que recebe um número. Este número serve para 
	indexar os elementos dos vector soma e quant, dessa forma cada posição pertence a um único nome.

	É feito um iterator para percorrer o vector de dados. Cada string de dados é separada em nome e valor. 
	O nome serve para indexar o map de indices. O valor é soma do vector de soma e contabilizado o vector 
	de quant.
*/

void split(string str, string separator, vector<string>* results){
    int found;
    found = str.find_first_of(separator);

    while(found != string::npos){
        if(found > 0){
            results->push_back(str.substr(0,found));
        }
		
        str = str.substr(found+1);
        found = str.find_first_of(separator);
    }

    if(str.length() > 0){
        results->push_back(str);
    }
}

int main(int argc, char const *argv[]){
	
	vector<string> dados = {"a 10", "b 8", "c 4", "a 8", "c 8"};
	int tamanho = dados.size();

	map<string, int> indices; 	//Mapeaia os indices do vetor
	vector<double> soma(tamanho);		//Armazena a soma individuais
	vector<int> quant(tamanho);		//Armazena a soma individuais
	int indice = 0;


	for(vector<string>::iterator iv = dados.begin(); iv != dados.end(); ++iv){
		vector<string> separado;
		cout << *iv << " \n";
		split(*iv, " ", &separado);

		string nome = separado.front();
		double valor = atof(separado.back().c_str());

		if(indices.find(nome) == indices.end()){
			indices.insert(pair<string, int>(nome, indice));
			indice++;
		}

		soma.at(indices.find(nome)->second) += valor;
		quant.at(indices.find(nome)->second)++;

		// cout << "Nome: " << nome << endl;
		// cout << "Valor: " << valor << endl << endl;
	}

	double somaTotal;
	int quantTotal = 0;

	for(map<string, int>::iterator it = indices.begin(); it != indices.end(); ++it){
		cout << "Nome: "<< it->first << " Soma: " << soma.at(it->second)
			 << " Media: " << (soma.at(it->second)/quant.at(it->second)) << endl;

		somaTotal += soma.at(it->second);
		quantTotal += quant.at(it->second);
	}

	cout << "Media total: " << (somaTotal/quantTotal) << endl;


	return 0;
}
