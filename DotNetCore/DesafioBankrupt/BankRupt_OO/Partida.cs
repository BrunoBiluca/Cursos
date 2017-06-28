using System;
using System.Collections.Generic;
using System.Text;
using System.Text.RegularExpressions;

namespace BankRupt_OO {
    class Partida {

        private int MaxRodadas = 1000;
        public int Rodadas { get; private set; }

        private List<Casa> Casas;
        private int NumPlayersAtivos;
        public Player Vencedor = null;
        public bool TimeOut = false;

        /// <summary>
        /// Contrutor para inicializar o tabuleiro da partida
        /// </summary>
        /// <param name="config"></param>
        public Partida(string[] config) {
            Rodadas = 0;

            Casas = new List<Casa>();
            foreach(string linha in config) {
                int valC = Convert.ToInt32(Regex.Split(linha, @"\s+")[0]);
                int valA = Convert.ToInt32(Regex.Split(linha, @"\s+")[1]);
                Casas.Add(new Casa() {
                    ValorCompra = valC,
                    ValorAluguel = valA
                });
            }
        }

        /// <summary>
        /// Método resposável por começar uma partida e retornar o seu vencedor
        /// </summary>
        /// <param name="players"></param>
        /// <returns></returns>
        public void Comecar(List<Player> players) {

            NumPlayersAtivos = players.Count;
            while (Rodadas < MaxRodadas && NumPlayersAtivos > 1) {
                foreach (var p in players) {
                    // Jogador que perdeu não joga
                    if (p.Perdeu) continue;

                    p.LancaDado();

                    VerificaPosicaoTabuleiro(p);
                    VerificaCondicaoDerrota(p);
                }
                
                Rodadas++;
            }

            DeterminaResultadoDaPartida(players);
        }

        /// <summary>
        /// Método resposável por Verificar se o Player foi derrotado nesse turno
        /// </summary>
        /// <param name="player"></param>
        private void VerificaCondicaoDerrota(Player player) {
            // Jogador Ainda não Faliu 😥
            if (player.Coins >= 0) return;

            player.PerdeuPartida();
            ResetCasasDoPlayer(player);
            NumPlayersAtivos--;
        }

        /// <summary>
        /// Método resposável por verificar as ações possíveis dada a posiçao do Player
        /// </summary>
        /// <param name="player"></param>
        private void VerificaPosicaoTabuleiro(Player player) {
            // Player deu a volta no tabuleiro
            if (player.Posicao >= Casas.Count) {
                player.RecebePagamento(100);
                player.Posicao -= Casas.Count;
            }

            // Casas pertece a um player
            if(Casas[player.Posicao].Proprietario != null && Casas[player.Posicao].Proprietario != player) {
                player.PagaJogador(Casas[player.Posicao].ValorAluguel, Casas[player.Posicao].Proprietario);
            } else{
                player.Acao(Casas[player.Posicao]);
            }
        }

        /// <summary>
        /// Método resposável por resetar todas as casas de um player que foi derrotado
        /// </summary>
        /// <param name="player"></param>
        private void ResetCasasDoPlayer(Player player) {
            foreach(var c in Casas) {
                if(c.Proprietario == player) {
                    c.Proprietario = null;
                }
            }
        }

        private void DeterminaResultadoDaPartida(List<Player> players) {
            if (Rodadas > MaxRodadas) TimeOut = true;

            // Busca todos os jogadores que não faliram e o vencedor é determinado
            // pelo critério de desempate (neste caso, ordem dos turnos)
            Vencedor = players.FindAll(p => !p.Perdeu)[0];
        }
    }
}
