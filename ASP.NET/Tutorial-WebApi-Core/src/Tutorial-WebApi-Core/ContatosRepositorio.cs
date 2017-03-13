using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Tutorial_WebApi_Core.Models;

namespace Tutorial_WebApi_Core {
    public class ContatosRepositorio : IContatosRepositorio {

        static List<Contato> listaContatos = new List<Contato>();

        public void Adicionar(Contato item) {
            throw new NotImplementedException();
        }

        public void Atualizar(Contato item) {
            throw new NotImplementedException();
        }

        public Contato Encontrar(string chave) {
            throw new NotImplementedException();
        }

        public IEnumerable<Contato> GetTodos() {
            throw new NotImplementedException();
        }

        public void Remover(string Id) {
            throw new NotImplementedException();
        }
    }
}
