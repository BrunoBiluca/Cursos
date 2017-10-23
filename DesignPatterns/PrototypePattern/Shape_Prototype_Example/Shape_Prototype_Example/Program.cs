using System;

namespace Shape_Prototype_Example {
    class Program {
        static void Main(string[] args) {
            ShapeCache.LoadCache();

            // São criados clones que podem ser manipulados sem a necessidade de depois buscar novamente o objeto

            Shape clonedRectangle = ShapeCache.GetShape(1);
            Console.WriteLine("Shape: " + clonedRectangle.Type);

            Shape clonedSquare = ShapeCache.GetShape(2);
            Console.WriteLine("Shape: " + clonedSquare.Type);

            Shape clonedCircle = ShapeCache.GetShape(3);
            Console.WriteLine("Shape: " + clonedCircle.Type);

            Console.ReadKey();
        }
    }
}
