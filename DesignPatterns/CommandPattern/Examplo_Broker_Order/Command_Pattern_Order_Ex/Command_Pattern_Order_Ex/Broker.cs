using System;
using System.Collections.Generic;
using System.Text;

namespace Command_Pattern_Order_Ex {
    /// <summary>
    /// Classe responsável por identificar e chamar a execução de cada command referente a Stock
    /// </summary>
    class Broker {

        private List<IOrder> OrderList = new List<IOrder>();

        public void TakeOrder(IOrder order) {
            OrderList.Add(order);
        }

        public void PlaceOrders() {
            foreach(var order in OrderList) {
                order.Execute();
            }
            OrderList.Clear();
        }

    }
}
