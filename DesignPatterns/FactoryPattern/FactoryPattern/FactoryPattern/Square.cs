using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace FactoryPattern {
    public class Square : Shape {
        public string Draw() {
            return "Estou executando o método em Square";
        }
    }
}