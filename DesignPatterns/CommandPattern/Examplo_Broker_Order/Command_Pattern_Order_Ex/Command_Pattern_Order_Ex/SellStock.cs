using System;
using System.Collections.Generic;
using System.Text;

namespace Command_Pattern_Order_Ex {
    class SellStock: IOrder {

        private Stock _Stock;

        public SellStock(Stock stock) {
            _Stock = stock;
        }

        public void Execute() {
            _Stock.Sell();
        }
    }
}
