using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace FactoryPattern {
    public class Rectangle : Shape {
        public string Draw() {
            return "Estou executando o método em Rectangle";
        }
    }
}