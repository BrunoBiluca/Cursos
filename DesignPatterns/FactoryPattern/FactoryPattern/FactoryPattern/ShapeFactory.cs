using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace FactoryPattern {
    public class ShapeFactory {
        /// <summary>
        /// Esta função retorna um objeto que implementa a interface Shape
        /// </summary>
        /// <param name="shapeType">Tipos: CIRCLE / RECTANGLE / SQUARE</param>
        /// <returns></returns>
        public Shape GetShape(string shapeType) {
            if (shapeType == null) {
                return null;
            }
            if (shapeType.ToLower().Equals("CIRCLE".ToLower())) {
                return new Circle();

            } else if (shapeType.ToLower().Equals("RECTANGLE".ToLower())) {
                return new Rectangle();

            } else if (shapeType.ToLower().Equals("SQUARE".ToLower())) {
                return new Square();
            }

            return null;
        }
    }
}