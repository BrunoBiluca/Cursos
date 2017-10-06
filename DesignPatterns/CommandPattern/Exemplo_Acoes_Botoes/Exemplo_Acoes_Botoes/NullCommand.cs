using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Acoes_Botoes {
    class NullCommand : ICommand{
        public void Execute(string ator) {
            Console.WriteLine($"Faz nada!");
        }

        public bool IsNull() {
            return false;
        }
    }
}
