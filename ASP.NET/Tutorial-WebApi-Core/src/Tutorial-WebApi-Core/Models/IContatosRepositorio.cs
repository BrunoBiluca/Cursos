using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace Tutorial_WebApi_Core.Models {
    interface IContatosRepositorio {
        void Adicionar(Contato item);
        IEnumerable<Contato> GetTodos();
        Contato Encontrar(string chave);
        void Remover(string Id);
        void Atualizar(Contato item);
    }
}
