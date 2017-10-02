using System;
using System.Collections.Generic;
using System.Text;

namespace Command_Pattern_Order_Ex {
    /// <summary>
    /// Modelo de dados para a entidade Stock
    /// </summary>
    class Stock { 
        public string Name { get; private set; }
        public int Quantity { get; private set; }

        public Stock(string name, int quant) {
            Name = name;
            Quantity = quant;
        }

        public void SetName(string name) {
            Name = name;
        }

        public void Buy() {
            Console.WriteLine($"Stock [Name: {Name}], Quantity: {Quantity}] bought");
        }

        public void Sell() {
            Console.WriteLine($"Stock [Name: {Name}], Quantity: {Quantity}] sold");
        }
    }
}
