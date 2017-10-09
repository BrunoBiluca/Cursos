using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Shape {
    class Circle: IShape {

        private String Color;
        private int X;
        private int Y;
        private int Radius;

        public Circle(string color) {
            Color = color;
        }

        public void SetX(int x) {
            X = x;
        }

        public void SetY(int y) {
            Y = y;
        }

        public void SetRadius(int radius) {
            Radius = radius;
        }

        public void Draw() {
            Console.WriteLine($"Circle: Draw() [Color : {Color}, x : {X}, y :{Y}, radius {Radius}");
        }
    }
}
