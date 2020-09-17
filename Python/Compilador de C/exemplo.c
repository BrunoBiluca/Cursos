/*	Bruno Bernardes da Costa
 * 	Programa na linguagem c para calcular a sequencia Fibonati de 10 numeros
 */

void main(){
  int a, b, auxiliar, i, n;

  a = 0;
  b = 1;

  print("Digite um número: ");

  scan("%d", &n);
  print("Série de Fibonacci:\n");
  print("%d\n", b);

  for(i = 0; i < n; i=i+1){
    auxiliar = a + b;
    a = b;
    b = auxiliar;

    print("%d\n", auxiliar);
  }
}
