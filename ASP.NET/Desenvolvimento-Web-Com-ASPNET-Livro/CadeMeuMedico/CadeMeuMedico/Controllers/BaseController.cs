using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using CadeMeuMedico.Filtros;

namespace CadeMeuMedico.Controllers{
    //Adiciona o comportamento para verificar o acesso do usuário
    [AutorizacaoDeAcesso]
    public class BaseController : Controller{
        protected override void OnActionExecuting(ActionExecutingContext filterContext) {
            base.OnActionExecuting(filterContext);
        }
    }
}