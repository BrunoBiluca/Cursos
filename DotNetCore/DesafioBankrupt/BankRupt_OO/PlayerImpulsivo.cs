using System;
using System.Collections.Generic;
using System.Text;

namespace BankRupt_OO {
    class PlayerImpulsivo: Player {
        public PlayerImpulsivo(string nome, int coins) : base(nome, coins) { }

        /// <summary>
        /// Método resposável por tomar a ação
        /// O jogador impulsivo compra qualquer propriedade sobre a qual ele parar
        /// </summary>
        /// <param name="casa"></param>
        public override void Acao(Casa casa) {
            if (casa.ValorCompra > Coins) return;

            Coins -= casa.ValorCompra;
            casa.Proprietario = this;
        }
    }
}
