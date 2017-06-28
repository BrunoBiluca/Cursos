using System;
using System.Collections.Generic;
using System.Text;
using System.Text.RegularExpressions;

namespace BankRupt_OO {
    class Analise {

        // Atributos para Analise dos dados
        public int NumPartidas;
        public long NumRodadas = 0;
        public long NumTimeOuts = 0;
        public Dictionary<string, int> ContVitoriasPorComportamento;

        public Analise(int numPartidas) {
            NumPartidas = numPartidas;
            ContVitoriasPorComportamento = new Dictionary<string, int>();
        }

        /// <summary>
        /// Seta os dados as serem analisados
        /// </summary>
        /// <param name="partida"></param>
        public void GravaDados(Partida partida) {
            NumRodadas += partida.Rodadas;

            if (partida.TimeOut) NumTimeOuts++;

            string comportamento = Regex.Replace(partida.Vencedor.GetType().ToString(), @".*?\.", "");
            if (ContVitoriasPorComportamento.ContainsKey(comportamento)) {
                ContVitoriasPorComportamento[comportamento]++;
            } else {
                ContVitoriasPorComportamento.Add(comportamento, 0);
            }
        }

        /// <summary>
        /// Retorna o valor por média aritmética das rodadas das partidas
        /// </summary>
        /// <returns></returns>
        public string MediaRodadas() {
            return ((float)NumRodadas / (float)NumPartidas).ToString("n2");
        }

        /// <summary>
        /// Retorna a porcentagem de vitorias por tipo de comportamento
        /// </summary>
        /// <returns></returns>
        public string PorcentagemPorComportamento() {
            string res = "";
            foreach(var comp in ContVitoriasPorComportamento) {
                res += $"{comp.Key} ganhou {Porcentagem(comp.Value,NumPartidas).ToString("n2")} \n";
            }

            return res;
        }

        /// <summary>
        /// Retorna o tipo de comportamento vencedor
        /// </summary>
        /// <returns></returns>
        public string ComportamentoVencedor() {
            int maiorNumVitorias = 0;
            string compVitorioso = "";
            foreach(var comp in ContVitoriasPorComportamento) {
                if(comp.Value > maiorNumVitorias) {
                    compVitorioso = comp.Key;
                    maiorNumVitorias = comp.Value;
                }
            }

            return compVitorioso.ToString();
        }

        private float Porcentagem(long v1, long v2) {
            return (float) v1 / (float)v2 * 100f;
        }
    }
}
