using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Threading.Tasks;
using ConstructionStore.Domain;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Filters;

namespace ConstructionStore.Web.Filters {
    /// <inheritdoc />
    /// <summary>
    /// Classe responsável por criar um filtro para quando uma requisição ajax retornaria um erro de domínio
    /// </summary>
    public class CustomExceptionFilter : ExceptionFilterAttribute {
        public override void OnException(ExceptionContext context) {

            var isAjaxCall = context.HttpContext.Request.Headers["X-Requested-With"] == "XMLHttpRequest";

            if (isAjaxCall) {
                context.HttpContext.Response.ContentType = "application/json";
                context.HttpContext.Response.StatusCode = 500;
                var message = context.Exception is DomainException ? context.Exception.Message : "An error ocurred";
                context.Result = new JsonResult(message);
                context.ExceptionHandled = true;
            }

            base.OnException(context);
        }
    }
}
