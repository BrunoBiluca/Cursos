using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GuessingGame.Classes {
    class BancoAnimais {

        public Caracteristica primeiro;

        public BancoAnimais() {
            primeiro = new Caracteristica(null, "monkey");
            Caracteristica segundo = new Caracteristica("lives in water", "shark");

            primeiro.lista.Add(segundo);
        }

    }
}
