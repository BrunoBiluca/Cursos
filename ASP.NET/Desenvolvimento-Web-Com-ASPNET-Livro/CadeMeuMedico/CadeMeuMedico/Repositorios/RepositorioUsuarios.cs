using System;
using System.Linq;
using System.Web.Security;
using CadeMeuMedico.Repositorios;
using CadeMeuMedico.Models;
using System.Web;

namespace CadeMeuMedico.Repositorios { 
    public class RepositorioUsuarios { 
        public static bool AutenticarUsuario(string login, string senha) {
            var senhaCriptografada = FormsAuthentication.HashPasswordForStoringInConfigFile(senha, "sha1");

            try {
                using (CadeMeuMedicoBDEntities bd = new CadeMeuMedicoBDEntities()) {
                    var QueryAutenticaUsuarios = bd.Usuarios.Where(x => x.Login == login && x.Senha == senhaCriptografada).SingleOrDefault();

                    if (QueryAutenticaUsuarios == null) {
                        return false;
                    } 
                    else {
                        RepositorioCookies.RegistraCookieAutenticacao(QueryAutenticaUsuarios.IDUsuario);
                        return true;
                    }
                }
            } catch (Exception) {
                return false;
            }
        }

        public static Usuarios RecuperaUsuarioPorID(long IDUsuario) {
            try {
                using (CadeMeuMedicoBDEntities bd = new CadeMeuMedicoBDEntities()) {
                    var usuario = bd.Usuarios.Where(u => u.IDUsuario == IDUsuario).SingleOrDefault();
                    return usuario;
                }
            } catch (Exception) {
                return null;
            }
        }

        public static Usuarios VerificaSeUsuarioEstaLogado() {
            var usuario = HttpContext.Current.Request.Cookies["UserCookieAuthenticantion"];
            if(usuario == null) {
                return null;
            } 
            else {
                long IDUsuario = Convert.ToInt64(RepositorioCriptografia.Descriptografar(usuario.Values["IDUsuario"]));
                var usuarioRetornado = RecuperaUsuarioPorID(IDUsuario);
                return usuarioRetornado;
            }
        }
    }
}