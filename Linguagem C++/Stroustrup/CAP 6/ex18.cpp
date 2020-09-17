/*
	Calculadora
*/

#include <iostream>
#include <string>
#include <map>
#include <cctype>

using namespace std;

enum Token_value{
	NOME,		NUMERO,		FIM,
	MAIS='+',	MENOS='-',	MUL='*',	DIV='/',
	IMPR=';',	ATRIB='=',	PE='(',		PD=')'
};
Token_value curr_tok = IMPR;

double expr(bool);
double term(bool);
double prim(bool);
Token_value get_token();
double erro(const string& s);

double number_value;
string string_value;
map<string, double> tabela;
int num_erros;

// Token_value get_token(){
// 	char ch = 0;
// 	cin >> ch;

// 	switch(ch){
// 		case 0:
// 			return curr_tok = FIM;
// 		case ';':  case '*':  case '/':
// 		case '+':  case '-':  case '(':
// 		case ')':  case '=':
// 			return curr_tok = Token_value(ch);
// 		case '0': case '1': case '2':
// 		case '3': case '4': case '5':
// 		case '6': case '7':	case '8':
// 		case '9': case '.':
// 			cin.putback(ch);
// 			cin >> number_value;
// 			return curr_tok = NUMERO;
// 		default:
// 			if(isalpha(ch)){
// 				cin.putback(ch);
// 				cin >> string_value;
// 				return curr_tok = NOME;
// 			}
// 			erro("unidade léxica inválida");
// 			return curr_tok = IMPR;
// 	}
// }

Token_value get_token(){
	char ch;
	do{
		if(!cin.get(ch)) return curr_tok = FIM;		//Lê caracter a caracter
	}while(ch != '\n' && isspace(ch));

	switch(ch){
		case 0:
			return curr_tok = FIM;
		case ';': case '\n':
			return curr_tok = IMPR;
		case '*':  case '/':
		case '+':  case '-':  case '(':
		case ')':  case '=':
			return curr_tok = Token_value(ch);
		case '0': case '1': case '2':
		case '3': case '4': case '5':
		case '6': case '7':	case '8':
		case '9': case '.':
			cin.putback(ch);
			cin >> number_value;
			return curr_tok = NUMERO;
		default:
			if(isalpha(ch)){
				string_value = ch;
				while(cin.get(ch) && isalnum(ch)) string_value.push_back(ch);
				cin.putback(ch);
				return curr_tok = NOME;
			}
			erro("unidade léxica inválida");
			return curr_tok = IMPR;
	}
}

double prim(bool get){
	if(get) get_token();

	switch(curr_tok){
		case NUMERO:{
			double v = number_value;
			get_token();
			return v;
		}
		case NOME:{
			double& v = tabela[string_value];
			if(get_token() == ATRIB) v = expr(true);
			return v;
		}
		case MENOS:
			return -prim(true);
		case PE:{
			double e = expr(true);
			if(curr_tok != PD) return erro(") esperado");
			get_token();
			return e;
		}
		default:
			return erro("primário esperado");
	}
}

double expr(bool get){
	double esq =term(get);

	for(;;){
		switch(curr_tok){
			case MAIS:
				esq += term(true);
				break;
			case MENOS:
				esq -= term(true);
				break;
			default:
				return esq;
		}
	}
}

double term(bool get){
	double esq = prim(get);

	for(;;){
		switch(curr_tok){
			case MUL:
				esq *= prim(true);
				break;
			case DIV:
				if(double d = prim(true)){
					esq /= d;
					break;
				}
				return erro("divisão por zero");
			default:
				return esq;
		}
	}
}

double erro(const string& s){
	num_erros++;
	cerr << "erro: " << s << "\n";
	return 1;
}

int main(int argc, char const *argv[]){

	tabela["pi"] = 3.1415926535897932385;
	tabela["e"] = 2.7182818284590352354;

	while(cin){
		get_token();
		if(curr_tok == FIM) break;
		if(curr_tok == IMPR) continue;
		cout << expr(false) << '\n';
	}
	return num_erros;
}