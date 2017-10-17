using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ObserverPattern {
    /// <summary>
    /// Interface responsável por definir as funções para os observadores.
    /// Define um função Update que recebe o estado novo do sujeito.
    /// </summary>
    interface IObserver {
        void Update(float temp, float humidity, float pressure);
    }
}
