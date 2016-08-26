using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Net.Http;
using WebAPI_Consumidor.Models;

namespace WebAPI_Consumidor {
    public partial class _Default : Page {

        HttpClient client;
        Uri usuarioUri;

        public _Default() {
            if (client == null) {
                client = new HttpClient();
                client.BaseAddress = new Uri("http://localhost:56853");
                client.DefaultRequestHeaders.Accept.Add(new System.Net.Http.Headers.MediaTypeWithQualityHeaderValue("application/json"));
            }
        }

        protected void Page_Load(object sender, EventArgs e) {
            if (!Page.IsPostBack) {
                getAll();
            }
        }

        private void getAll() {
            //chamando a api pela url
            HttpResponseMessage response = client.GetAsync("api/Usuarios").Result;

            //se retornar com sucesso busca os dados
            if (response.IsSuccessStatusCode) {
                //pegando o cabeçalho
                usuarioUri = response.Headers.Location;

                //Pegando os dados do Rest e armazenando na variável usuários
                var usuarios = response.Content.ReadAsAsync<IEnumerable<Usuario>>().Result;

                //preenchendo a lista com os dados retornados da variável
                GridView1.DataSource = usuarios;
                GridView1.DataBind();
            }
            //Se der erro na chamada, mostra o status do código de erro.
            else
                Response.Write(response.StatusCode.ToString() + " - " + response.ReasonPhrase);
        }

        protected void GridView1_RowCommand(object sender, GridViewCommandEventArgs e) {
            if (e.CommandName == "Excluir") {
                //Pega a posição clicada no gridview
                int index = int.Parse((string)e.CommandArgument);
                //Pega a id do elemento para deletar
                string chave = GridView1.DataKeys[index]["id"].ToString();
                Delete(chave);
                Response.Redirect(Request.RawUrl);
            }

            if (e.CommandName == "Atualizar") {
                int index = int.Parse((string)e.CommandArgument);
                string chave = GridView1.DataKeys[index]["id"].ToString();
                string nome = Server.HtmlDecode(GridView1.Rows[index].Cells[1].Text);

                hdId.Value = chave;
                txtNome.Text = nome;
                txtNome.Focus();
            }
        }

        private void Delete(string id) {
            HttpResponseMessage response = client.DeleteAsync("api/Usuarios/" + id).Result;
            if (response.IsSuccessStatusCode) {
                usuarioUri = response.Headers.Location;
            } else {
                Response.Write(response.StatusCode.ToString() + " - " + response.ReasonPhrase.ToString());
            }
        }

        protected void cmdAtualizar_Click(object sender, EventArgs e) {
            Update(int.Parse(hdId.Value), txtNome.Text);
        }

        private void Update(int _id, string _nome) {
            var usuario = new Usuario() { id = _id, nome = _nome };
            HttpResponseMessage response = client.PutAsJsonAsync("api/Usuarios/" + _id, usuario).Result;
            if (response.IsSuccessStatusCode) {
                usuarioUri = response.Headers.Location;
            } else {
                Response.Write(response.StatusCode.ToString() + " - " + response.ReasonPhrase.ToString());
            }
            getAll();
        }

        protected void cmdBuscarNome_Click(object sender, EventArgs e) {
            HttpResponseMessage response = client.GetAsync("api/Usuarios/?name=" + txtBuscaNome.Text).Result;
            if (response.IsSuccessStatusCode) {
                usuarioUri = response.Headers.Location;
                var usuarios = response.Content.ReadAsAsync<IEnumerable<Usuario>>().Result;

                GridView1.DataSource = usuarios;
                GridView1.DataBind();
            } else
                Response.Write(response.StatusCode.ToString() + " - " + response.ReasonPhrase);
        }

    }
}