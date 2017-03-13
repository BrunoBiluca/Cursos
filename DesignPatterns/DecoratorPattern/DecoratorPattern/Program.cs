using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DecoratorPattern {
    class Program {
        static void Main(string[] args) {

            Beverage beverage = new Expresso();
            Console.WriteLine(beverage.getDescription() + " $" + beverage.cost());

            Beverage beverage2 = new HouseBlend();
            beverage2.setSize(Beverage.VENTI);
            Console.WriteLine(beverage2.getDescription() + " $" + beverage2.cost());
            beverage2 = new Mocha(beverage2);
            Console.WriteLine(beverage2.getDescription() + " $" + beverage2.cost());

            Console.ReadKey();
        }
    }
}
