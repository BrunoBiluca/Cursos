using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DecoratorPattern {
    class Mocha : CondimentDecorator {

        public Mocha(IBeverage beverage) : base(beverage) { 
        }

        public override string getDescription() {
            return beverage.getDescription() + ", Mocha";
        }

        public override string getSize() {
            return beverage.getSize();
        }

        public override double cost() {
            double cost = beverage.cost();
            if (this.getSize() == Beverage.TALL) cost += 0.10;
            else if (this.getSize() == Beverage.GRANDE) cost += 0.15;
            else if (this.getSize() == Beverage.VENTI) cost += 0.20;

            return cost;
        }
    }
}
