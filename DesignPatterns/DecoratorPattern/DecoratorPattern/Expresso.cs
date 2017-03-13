using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DecoratorPattern {
    /// <summary>
    /// Bebida Expresso
    /// </summary>
    class Expresso : Beverage {

        public Expresso() {
            this.description = "Expresso";
        }

        override public double cost() {
            return 1.99;
        }

    }
}
