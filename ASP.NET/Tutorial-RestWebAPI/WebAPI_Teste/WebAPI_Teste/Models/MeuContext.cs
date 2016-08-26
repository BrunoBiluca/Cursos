using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data.Entity;

namespace WebAPI_Teste.Models {
    public class MeuContext : DbContext {

        public MeuContext() : base("name=MeuContext") {

        }

        public System.Data.Entity.DbSet<WebAPI_Teste.Models.Usuario> Usuarios { get; set; }
    }
}