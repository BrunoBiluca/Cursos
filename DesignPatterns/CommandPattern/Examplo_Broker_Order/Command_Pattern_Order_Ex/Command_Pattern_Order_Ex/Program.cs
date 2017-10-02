using System;

namespace Command_Pattern_Order_Ex {
    class Program {
        static void Main(string[] args) {
            // Cria o modelo de dados que vai ser manipulado
            Stock camisas = new Stock("Camisa Polo", 10);

            // Cria o objeto que identifica qual o comando a ser executado
            Broker broker = new Broker();

            // Cria os comandos a serem executados
            BuyStock buyStockOrder = new BuyStock(camisas);
            SellStock sellStockOrder = new SellStock(camisas);

            broker.TakeOrder(buyStockOrder);
            broker.TakeOrder(sellStockOrder);
            broker.PlaceOrders();

            Console.ReadKey();
        }
    }
}