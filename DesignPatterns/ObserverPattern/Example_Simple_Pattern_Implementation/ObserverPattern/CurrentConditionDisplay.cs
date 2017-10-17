using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ObserverPattern {
    /* Classe responsável por mostrar os dados atuais disponibilizados
     * pela classe WeatherData */
    class CurrentConditionDisplay : IObserver, IDisplayElement {
        
        // EStados providos pela classe WeatherData
        private float temperature;
        private float humidity;
        private Subject weatherData; // Refenrência para o sujeito

        public CurrentConditionDisplay(Subject weatherData) {
            this.weatherData = weatherData;
            weatherData.RegisterObserver(this);
        }

        public void Update(float temp, float humidity, float pressure) {
            this.temperature = temp;
            this.humidity = humidity;
            Display();
        }

        public void Display() {
            Console.WriteLine("Current Conditions: " + temperature + "F degrees and " + humidity + "% humidity");
        }
    }
}
