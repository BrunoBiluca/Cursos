using System;
using System.Collections.Generic;
using System.Text;

namespace BankRupt_OO {
    class PlayerAleatorio: Player {
        public PlayerAleatorio(string nome, int coins) : base(nome, coins) { }

        /// <summary>
        /// Método resposável por tomar a ação
        /// O jogador aleatório compra a propriedade que ele parar em cima com probabilidade de 50%
        /// </summary>
        /// <param name="casa"></param>
        public override void Acao(Casa casa) {
            if (casa.ValorCompra > Coins) return;

            int prob = Program.rand.Next(100);
            if(prob >= 50){
                Coins -= casa.ValorCompra;
                casa.Proprietario = this;
            }
        }
    }
}
