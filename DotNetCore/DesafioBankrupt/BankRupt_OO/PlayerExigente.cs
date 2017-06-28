using System;
using System.Collections.Generic;
using System.Text;

namespace BankRupt_OO {
    class PlayerExigente: Player {
        public PlayerExigente(string nome, int coins) : base(nome, coins) { }

        /// <summary>
        /// Método resposável por tomar a ação
        /// O jogador exigente compra qualquer propriedade, desde que o aluguel dela seja maior do que 50 ​coins. 
        /// </summary>
        /// <param name="casa"></param>
        public override void Acao(Casa casa) {
            if (casa.ValorCompra > Coins) return;

            if(casa.ValorAluguel > 50) {
                Coins -= casa.ValorCompra;
                casa.Proprietario = this;
            }
        }
    }
}
