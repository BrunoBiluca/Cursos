using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace CadeMeuMedico.Controllers{
    public class TesteLayoutController : BaseController {
        // GET: TesteLayout
        public ActionResult Index(){
            return View();
        }

        public ActionResult Login() {
            ViewBag.Title = "Seja bem vindo(a)";
            return View();
        }
    }
}