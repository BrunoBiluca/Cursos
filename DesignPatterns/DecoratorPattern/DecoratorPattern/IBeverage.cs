using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DecoratorPattern {
    /// <summary>
    /// Interface para os métodos que devem ser implementados pelas classes de bebidas e 
    /// pelos decoradores de bebidas
    /// </summary>
    interface IBeverage {
        string getDescription();
        void setSize(string size);
        string getSize();
        double cost();
    }
}
