using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace FactoryPattern {
    public class Circle : Shape {
        public string Draw() {
            return "Estou executando o método draw dentro de Circle";
        }
    }
}