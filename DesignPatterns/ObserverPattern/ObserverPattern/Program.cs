using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ObserverPattern {
    class Program {
        static void Main(string[] args) {

            // Crio a instância para a classe Subject
            WeatherData weatherData = new WeatherData();

            // Crio a instância para a classe Observer
            CurrentConditionDisplay currentDisplay = new CurrentConditionDisplay(weatherData);

            weatherData.SetMeasurements(80, 65, 30.4f);
            weatherData.SetMeasurements(82, 70, 29.2f);
            weatherData.SetMeasurements(78, 90, 29.2f);

            Console.ReadKey();
        }
    }
}
