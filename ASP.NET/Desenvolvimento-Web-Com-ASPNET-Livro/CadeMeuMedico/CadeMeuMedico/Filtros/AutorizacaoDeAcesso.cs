using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using CadeMeuMedico.Repositorios;

namespace CadeMeuMedico.Filtros {
    [HandleError] //Gerenciador de erros automaticos
    [AttributeUsage(AttributeTargets.Class | AttributeTargets.Method,
                    Inherited = true,
                    AllowMultiple = true)] //Comportamento que esperamos encontrar ao utilizar o filtro
    public class AutorizacaoDeAcesso : ActionFilterAttribute {
        public override void OnActionExecuting(ActionExecutingContext filtroDeContexto) {
            var controller = filtroDeContexto.ActionDescriptor.ControllerDescriptor.ControllerName;
            var action = filtroDeContexto.ActionDescriptor.ActionName;

            if(controller != "TesteLayout" || action != "Login") {
                if(RepositorioUsuarios.VerificaSeUsuarioEstaLogado() == null) {
                    filtroDeContexto.
                        HttpContext.
                        Response.
                        Redirect("/TesteLayout/Login?Url=" + filtroDeContexto.HttpContext.Request.Url.LocalPath);
                }
            }

        }        
    }
}