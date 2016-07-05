using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using MySql.Data.MySqlClient;
using System.Data;

//Conexão com o banco de dados
//Banco de dados deve estar sendo executado no servidor local
public partial class _Default : System.Web.UI.Page {
    protected void Page_Load(object sender, EventArgs e) {
        MySqlConnection conexao = new MySqlConnection("server=127.0.0.1; User Id=root; database=testemysql; password=root");
        MySqlCommand comando = new MySqlCommand("SELECT * FROM pessoas", conexao);
        DataTable tabela = new DataTable();
        try {
            conexao.Open();
            gdvDados.DataSource = comando.ExecuteReader();
            gdvDados.DataBind();
        } finally {
            conexao.Close();
        }

    }
}