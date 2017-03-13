using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DecoratorPattern {
    /// <summary>
    /// Classe responsável por determinar o comportamento das classes de condimentos
    /// </summary>
    abstract class CondimentDecorator : Beverage {
        // Referência para a bebida que a Moca está decorando
        protected IBeverage beverage;

        // Inserindo o override eu forço ao Condiment Decorator sobreescrever o método da classe Beverage
        // Como eu não vou sobreescrever os métodos aqui na classe de CondimentDecorator, passo isso para os filhos
        // Os filhos devem implementar os métodos, já que estes estão definidos na interface
        override abstract public string getDescription();
        override abstract public string getSize();

        public CondimentDecorator(IBeverage beverage) {
            this.beverage = beverage;
        }
    }
}
