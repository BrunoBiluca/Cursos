using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GuessingGame.Classes {
    public class Caracteristica {

        private string dica;
        private string animal;
        public List<Caracteristica> lista;

        public Caracteristica(string dica, string animal) {
            this.dica = dica;
            this.animal = animal;
            lista = new List<Caracteristica>();
        }

        public string getDica() {
            return this.dica;
        }

        public string getAnimal() {
            return this.animal;
        }

    }
}
