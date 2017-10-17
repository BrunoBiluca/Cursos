using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ObserverPattern {
    // Classe responsável por prover os dados para a estação meteorológica.
    /* Como esta classe implementa o Subject todos os seus observadores devem 
     * ser notificados assim que o seu estado for alterado. */
    class WeatherData : ISubject {
        private List<Observer> observers; // Lista de observadores que seram avisados quando o estado mudar

        // Estados da classe WeatherData
        private float temperature;        
        private float humidity;
        private float pressure;

        // Construtor
        public WeatherData() {
            observers = new List<Observer>();
        }

        // Adiciona um observador na lista de observadores
        public void RegisterObserver(Observer o) {
            observers.Add(o);
        }

        // Remove um observador da lista de observadores
        public void RemoveObserver(Observer o) {
            observers.Remove(o);
        }

        // Notifica todos os observadores da lista de observadores
        public void NotifyObservers() {
            foreach (Observer o in observers) {
                /* Como cada observador implementa a interface Observer, 
                 * o observador deve ser atualizado */
                o.Update(temperature, humidity, pressure);
            }
        }

        // Função responsável por tratar quando uma mudança no estado é feita
        public void MeasurementsChanged() {
            NotifyObservers();
        }

        // Função responsável por mudar o estado da classe WeatherData
        public void SetMeasurements(float temperature, float humidity, float pressure) {
            this.temperature = temperature;
            this.humidity = humidity;
            this.pressure = pressure;
            MeasurementsChanged();
        }
    }
}
