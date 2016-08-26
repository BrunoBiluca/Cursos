using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Description;
using WebAPI_Teste.Models;

namespace WebAPI_Teste.Controllers{
    public class UsuariosController : ApiController {
        private MeuContext db = new MeuContext();

        // GET: api/Usuarios
        public IEnumerable<Usuario> GetUsuarios() {
            return db.Usuarios;
        }

        // GET: api/Usuarios/5
        [ResponseType(typeof(Usuario))]
        public IHttpActionResult GetUsuario(int id) {
            Usuario usuario = db.Usuarios.Find(id);
            if (usuario == null) {
                return NotFound();
            }

            return Ok(usuario);
        }

        //GET: api/Usuarios/?name=
        public IEnumerable<Usuario> GetUsuarioByName(string name) {
            var usuario = db.Usuarios.Where(x => x.nome.Contains(name)).AsEnumerable();
            if (usuario == null)
                throw new HttpResponseException(Request.CreateResponse(HttpStatusCode.NotFound));

            return usuario;
        }

        // PUT: api/Usuarios/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutUsuario(int id, Usuario usuario) {
            if (!ModelState.IsValid) {
                return BadRequest(ModelState);
            }

            if (id != usuario.id) {
                return BadRequest();
            }

            db.Entry(usuario).State = EntityState.Modified;

            try {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException) {
                if (!UsuarioExists(id)) {
                    return NotFound();
                }
                else {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/Usuarios
        [ResponseType(typeof(Usuario))]
        public IHttpActionResult PostUsuario(Usuario usuario) {
            if (!ModelState.IsValid) {
                return BadRequest(ModelState);
            }

            db.Usuarios.Add(usuario);
            db.SaveChanges();

            return CreatedAtRoute("DefaultApi", new { id = usuario.id }, usuario);
        }

        // DELETE: api/Usuarios/5
        [ResponseType(typeof(Usuario))]
        public IHttpActionResult DeleteUsuario(int id) {
            Usuario usuario = db.Usuarios.Find(id);
            if (usuario == null) {
                return NotFound();
            }

            db.Usuarios.Remove(usuario);
            db.SaveChanges();

            return Ok(usuario);
        }

        protected override void Dispose(bool disposing) {
            if (disposing) {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool UsuarioExists(int id) {
            return db.Usuarios.Count(e => e.id == id) > 0;
        }
    }
}