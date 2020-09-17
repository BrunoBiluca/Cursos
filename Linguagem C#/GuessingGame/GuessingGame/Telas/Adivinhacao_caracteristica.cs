using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using GuessingGame.Classes;

namespace GuessingGame.Telas {
    public partial class Adivinhacao_caracteristica : Form {
        private Caracteristica caracteristica;

        static private int pos = 0;

        public Adivinhacao_caracteristica() {
            InitializeComponent();
        }

        public Adivinhacao_caracteristica(Caracteristica caracteristica) {
            this.caracteristica = caracteristica;
            InitializeComponent();
        }

        private void Adivinhacao_caracteristica_Load(object sender, EventArgs e) {
            label_caracteristica.Text += caracteristica.lista[pos].getDica()+"?";
            this.Location = new Point(400, 200);
        }

        private void btn_yes_Click(object sender, EventArgs e) {

            if (caracteristica.lista[pos].lista.Any()) {
                var prox_caracteristica = caracteristica.lista[pos];
                var prox_tela = new Adivinhacao_caracteristica(prox_caracteristica);
                pos = 0;
                prox_tela.StartPosition = FormStartPosition.CenterParent;
                prox_tela.Show();
                Close();
            } else {
                var continua_caracteristica = caracteristica.lista[pos];
                var prox_tela = new Adivinhacao_animal(continua_caracteristica);
                pos = 0;
                prox_tela.StartPosition = FormStartPosition.CenterParent;
                prox_tela.Show();
                Close();
            }

        }

        private void btn_no_Click(object sender, EventArgs e) {
            if ((pos+1) < caracteristica.lista.Count) {
                var continua_caracteristica = caracteristica;
                var prox_tela = new Adivinhacao_caracteristica(continua_caracteristica);
                pos++;
                prox_tela.StartPosition = FormStartPosition.CenterParent;
                prox_tela.Show();
                Close();
            } else {
                var continua_caracteristica = caracteristica;
                var prox_tela = new Adivinhacao_animal(continua_caracteristica);
                pos = 0;
                prox_tela.StartPosition = FormStartPosition.CenterParent;
                prox_tela.Show();
                Close();
            }
        }
    }
}
