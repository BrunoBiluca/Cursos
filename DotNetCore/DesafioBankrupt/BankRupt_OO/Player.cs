using System;
using System.Collections.Generic;
using System.Text;

namespace BankRupt_OO {
    class Player {

        public string Nome;
        public int Coins { get; protected set; }
        public int ValorDado;
        public int Posicao = 0;
        public bool Perdeu = false;
        
        public Player(string nome, int coins) {
            Nome = nome;
            Coins = coins;
        }

        /// <summary>
        /// Método resposável por atualizar a posiçao do player
        /// </summary>
        public void LancaDado() {
            ValorDado = Program.rand.Next(1, 7); //Dado
            Posicao += ValorDado;
        }

        /// <summary>
        /// Método resposável por receber o pagamento de outro player
        /// </summary>
        /// <param name="valor"></param>
        public void RecebePagamento(int valor) {
            Coins += valor;
        }

        /// <summary>
        /// Método resposável por pagar outro jogador
        /// </summary>
        /// <param name="valorAluguel"></param>
        /// <param name="proprietario"></param>
        public void PagaJogador(int valorAluguel, Player proprietario) {
            Coins -= valorAluguel;
            proprietario.RecebePagamento(valorAluguel);
        }

        /// <summary>
        /// Método resposável por determinar a ação de um player
        /// Por padrão o jogador é Impulsivo
        /// </summary>
        /// <param name="casa"></param>
        public virtual void Acao(Casa casa) {
            if (casa.ValorCompra > Coins) return;

            Coins -= casa.ValorCompra;
            casa.Proprietario = this;
        }

        /// <summary>
        /// Método resposável por atualizar o estado quando o player é derrotado
        /// </summary>
        public void PerdeuPartida() {
            Perdeu = true;
        }
    }
}
