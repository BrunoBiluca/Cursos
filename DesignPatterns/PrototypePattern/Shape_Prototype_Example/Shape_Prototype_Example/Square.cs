using System;
using System.Collections.Generic;
using System.Text;

namespace Shape_Prototype_Example {
    class Square : Shape{

        public Square() => Type = "Square";

        public override void Draw() {
            Console.WriteLine("Inside Square:Draw() method");
        }

    }
}
