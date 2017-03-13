using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DecoratorPattern {
    /// <summary>
    /// Classe responsável por determinar os métodos que deverão ser implementados em todos as classes
    /// que serão decoradas ou nos decoradores
    /// Classe que determina os métodos para as bebidas da loja de Café
    /// </summary>
    abstract class Beverage : IBeverage{
        public static string TALL = "TALL";
        public static string GRANDE = "GRANDE";
        public static string VENTI = "VENTI";
        protected string description = "Unknown Beverage";
        private string size;

        public virtual string getDescription() {
            return this.description;
        }

        public void setSize(string size) { 
            this.size = size;
        }

        public virtual string getSize() {
            return this.size;
        }

        // Ou a classe implementa o método da interface ou ela passa essa responsablidade para os filhos
        public abstract double cost();
    }
}
