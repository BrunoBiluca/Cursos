using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ObserverPattern {
    /// <summary>
    /// Interface do Sujeito do Padrão
    /// Por ela sabemos que é a classe que as outras classes estão observando
    /// </summary>
    interface ISubject {
        void RegisterObserver(Observer o);
        void RemoveObserver(Observer o);
        void NotifyObservers();
    }
}
