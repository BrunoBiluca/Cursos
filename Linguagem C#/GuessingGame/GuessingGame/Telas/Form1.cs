using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using GuessingGame.Classes; //Usando as classes do jogo
using GuessingGame.Telas;

namespace GuessingGame {
    public partial class Form1 : Form {
        public Form1() {
            InitializeComponent();
        }

        private void btn_ok_Click(object sender, EventArgs e) {
            var primeira_caracteristica = Program.ba.primeiro;
            var prox_tela = new Adivinhacao_caracteristica(primeira_caracteristica);
            prox_tela.StartPosition = FormStartPosition.CenterParent;
            prox_tela.Show();
            Hide();
        }

        private void btn_cancelar_Click(object sender, EventArgs e) {
            Application.Exit();
        }

        private void Form1_Load(object sender, EventArgs e) {
            this.Location = new Point(400, 200);
        }
    }
}
