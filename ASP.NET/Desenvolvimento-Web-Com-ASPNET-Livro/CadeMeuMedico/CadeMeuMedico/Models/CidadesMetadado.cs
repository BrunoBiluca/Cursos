using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.ComponentModel.DataAnnotations;

namespace CadeMeuMedico.Models {

    [MetadataType(typeof(CidadesMetadado))]
    public partial class Cidades {

    }

    public class CidadesMetadado {
        [Required(ErrorMessage = "Obrigatório informar o Nome")] 
        [StringLength(100, ErrorMessage = "O Nome deve possuir no máximo 100 caracteres")] 
        public string Nome { get; set; }
    }
}