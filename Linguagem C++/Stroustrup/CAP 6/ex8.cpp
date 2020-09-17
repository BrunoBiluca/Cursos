#include <iostream>
#include <climits>

using namespace std;

int main(int argc, char const *argv[]){
	
	//cout << "Divisão por zero" << (1/0) << endl;
	int max = INT_MAX;
	cout << "Overflow: " << (max+1) << endl;
	int min = INT_MIN;
	cout << "Underflow: " << (min-1) << endl;

	return 0;
}