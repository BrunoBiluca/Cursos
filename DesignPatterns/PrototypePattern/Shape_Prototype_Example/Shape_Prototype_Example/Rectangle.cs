using System;
using System.Collections.Generic;
using System.Text;

namespace Shape_Prototype_Example {
    class Rectangle : Shape {
        public Rectangle() => Type = "Rectangle";

        public override void Draw() {
            Console.WriteLine("Inside Rectangle:Draw() method");
        }

    }
}
