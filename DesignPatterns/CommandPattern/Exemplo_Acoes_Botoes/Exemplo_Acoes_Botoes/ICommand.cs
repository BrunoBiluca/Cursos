using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Acoes_Botoes {
    /// <summary>
    /// Interface primordial no Padrão Commmand
    /// </summary>
    public interface ICommand {
        void Execute(string ator);
        bool IsNull();
    }
}
