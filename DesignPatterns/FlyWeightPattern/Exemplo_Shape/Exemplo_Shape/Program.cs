using System;

namespace Exemplo_Shape {
    /// <summary>
    /// Este exemplo consiste em criar instâncias da Classe Circle com várias cores.
    /// De forma a evitar construir vários objetos repetidos podemos utilizar o padrão FlyWeight
    /// Utilizamos apenas uma instância diferente do objeto e alteramos seus outros valores em tempo de execução
    /// </summary>
    class Program {

        private static string[] colors = new string[] {
            "Red", "Green", "Blue", "White", "Black"
        };

        private static Random random = new Random();

        static void Main(string[] args) {
            for(int i = 0; i < 20; i++) {
                Circle circle = (Circle)ShapeFactory.GetCircle(GetRandomColor());

                // Setamos os valores dinamicamente para o objeto, isso altera a instância na lista do factory
                // porém este não é um problema já que novos valores serão passados sempre que o objeto for passado
                circle.SetX(GetRandomX());
                circle.SetY(GetRandomY());
                circle.SetRadius(100);
                circle.Draw();
            }
            Console.ReadKey();
        }

        private static string GetRandomColor() {
            return colors[random.Next(colors.Length - 1)];
        }

        private static int GetRandomX() {
            return random.Next(100);
        }

        private static int GetRandomY() {
            return random.Next(100);
        }
    }
}
