using System;
using System.Collections.Generic;
using System.Text;

namespace Shape_Prototype_Example {
    class Circle : Shape {

        public Circle() => Type = "Circle";

        public override void Draw() {
            Console.WriteLine("Inside Circle:Draw() method");
        }
    }
}
