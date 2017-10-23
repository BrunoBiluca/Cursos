using System;
using System.Collections.Generic;
using System.Text;

namespace Shape_Prototype_Example {
    class ShapeCache {

        /// Lista de objectos originais
        private static Dictionary<int, Shape> ShapeMap = new Dictionary<int, Shape>();

        /// Retorna sempre um clone da lista de cache
        public static Shape GetShape(int id) {
            return (Shape) ShapeMap[id].Clone();
        }

        /// Carrega todos os objetos de uma vez
        public static void LoadCache() {
            Rectangle rectangle = new Rectangle {
                Id = 1
            };
            ShapeMap.Add(rectangle.Id, rectangle);

            Square square = new Square {
                Id = 2
            };
            ShapeMap.Add(square.Id, square);

            Circle circle = new Circle {
                Id = 3
            };
            ShapeMap.Add(circle.Id, circle);
        }

    }
}
