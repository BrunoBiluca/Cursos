using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FactoryPattern {
    class Program {
        static void Main(string[] args) {

            ShapeFactory shapeFactory = new ShapeFactory();

            Shape shape1 = shapeFactory.GetShape("CIRCLE");


            //Podemos usar 
            List<Shape> listaShape = new List<Shape>();
            Rectangle r = new Rectangle();
            Square s = new Square();
            Circle c = new Circle();
            listaShape.Add(s);
            listaShape.Add(r);
            listaShape.Add(c);

            foreach (Shape shape in listaShape) {
                Console.WriteLine("Dentro da lista" + shape.Draw());
            }

            //call draw method of Circle
            Console.WriteLine(shape1.Draw());

            //get an object of Rectangle and call its draw method.
            Shape shape2 = shapeFactory.GetShape("RECTANGLE");

            //call draw method of Rectangle
            Console.WriteLine(shape2.Draw());

            //get an object of Square and call its draw method.
            Shape shape3 = shapeFactory.GetShape("SQUARE");

            //call draw method of circle
            Console.WriteLine(shape3.Draw());

            Console.ReadKey();

        }
    }
}
