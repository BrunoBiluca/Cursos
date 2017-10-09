using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Shape {
    class ShapeFactory {
        private static Dictionary<string, IShape> CircleMap = new Dictionary<string, IShape>();

        /// <summary>
        /// Verifica se o círculo já foi criado e está armazenada no CircleMap
        /// Dessa forma mantemos apenas uma instância do objeto que queremos replicar
        /// </summary>
        /// <param name="color"></param>
        /// <returns></returns>
        public static IShape GetCircle(string color) {
            Circle circle = (Circle)CircleMap.GetValueOrDefault(color);

            if (circle == null) {
                circle = new Circle(color);
                CircleMap.Add(color, circle);
                Console.WriteLine($"Creating circle of color: {color}");
            }

            circle.Draw();
            return circle;
        }

    }
}
