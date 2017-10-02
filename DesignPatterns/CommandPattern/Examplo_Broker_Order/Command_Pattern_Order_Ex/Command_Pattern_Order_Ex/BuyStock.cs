using System;
using System.Collections.Generic;
using System.Text;

namespace Command_Pattern_Order_Ex {
    class BuyStock: IOrder {

        // Referencia ao modelo de dados que será manipulado
        // Passar uma referencia do modelo de dados é uma forma de composição
        // Dessa forma não é necessário herdar a classe Stock para saber seu estado e comportamento
        private Stock _Stock;

        public BuyStock(Stock stock) {
            _Stock = stock;
        }

        public void Execute() {
            _Stock.Buy();
        }
    }
}
