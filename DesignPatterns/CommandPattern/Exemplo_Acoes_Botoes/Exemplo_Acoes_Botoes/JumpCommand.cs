using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Acoes_Botoes {
    class JumpCommand: ICommand {
        public virtual void Execute(string ator) {
            Console.WriteLine($"{ator}: Voar Voar Subir Subir!");
        }
    }
}
