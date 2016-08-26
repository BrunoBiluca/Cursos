using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.ComponentModel.DataAnnotations;

namespace WebAPI_Teste.Models {
    public class Usuario {

        [Key]
        public int id { get; set; }

        public string nome { get; set; }

    }
}