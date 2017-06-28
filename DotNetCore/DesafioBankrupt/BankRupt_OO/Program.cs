using System;
using System.Collections.Generic;
using System.IO;

namespace BankRupt_OO {
    class Program {

        public static Random rand = new Random(); 

        static void Main(string[] args) {

            // Leitura do arquivo de configuração do tabuleiro
            string[] places = File.ReadAllLines("gameConfig.txt");

            int MaxPartidas = 300;
            int partidas = 0;

            Analise analise = new Analise(MaxPartidas);
            
            while (partidas < MaxPartidas) {
                // Definir os jogadores
                List<Player> players = InicializaPlayers();

                // Iniciar a partida
                Partida partida = new Partida(places);
                partida.Comecar(players);

                analise.GravaDados(partida);

                partidas++;
            }

            ExibirResultados(analise);
        }

        static private void ExibirResultados(Analise analise) {
            // Exibir o resultado
            Console.WriteLine("Resultado:");
            Console.WriteLine($"Numero de partidas que terminaram por time out: {analise.NumTimeOuts}");
            Console.WriteLine();
            Console.WriteLine($"Numero medio de rodadas por partida: {analise.MediaRodadas()}");
            Console.WriteLine();
            Console.WriteLine($"Porcentagem de vitorias por comportamento:\n{analise.PorcentagemPorComportamento()}");
            Console.WriteLine();
            Console.WriteLine($"Comportamento vencedor: {analise.ComportamentoVencedor()}");
            Console.ReadKey();
        }

        static private List<Player> InicializaPlayers() {
             List<Player> players = new List<Player>(){
                new PlayerImpulsivo("Mr. Impulsivo", 300),
                new PlayerExigente("Sr. Exigente", 300),
                new PlayerCauteloso("Sra. Cautelosa", 300),
                new PlayerAleatorio("Miss. Aleatoria", 300),
            };

            // Embaralhar os jogadores
            Shuffle<Player>(ref players);

            return players;
        }

        /// <summary>
        /// Embaralhamento baseado no Fisher-Yates shuffle
        /// </summary>
        /// <typeparam name="T"></typeparam>
        /// <param name="list"></param>
        public static void Shuffle<T>(ref List<T> list){  
            int n = list.Count;  
            while (n > 1) {  
                n--;  
                int k = rand.Next(n + 1);  
                T value = list[k];  
                list[k] = list[n];  
                list[n] = value;  
            }
        }
    }
}