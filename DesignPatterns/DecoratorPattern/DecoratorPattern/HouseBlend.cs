using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DecoratorPattern {
    /// <summary>
    /// Bebida House Blend
    /// </summary>
    class HouseBlend : Beverage{

        public HouseBlend() {
            this.description = "House Blend Coffee";
        }

        override public double cost(){
            return 0.89;
        }

    }
}
