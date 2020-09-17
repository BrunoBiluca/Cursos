#include <limits>
#include <iostream>
using namespace std;

int main(int argc, char const *argv[]){
	
	cout << "Maior int == " << numeric_limits<int>::max() << "\n";
	cout << "Maior float == " << numeric_limits<float>::max() << "\n";
	cout << "Maior double == " << numeric_limits<double>::max() << "\n";

	return 0;
}