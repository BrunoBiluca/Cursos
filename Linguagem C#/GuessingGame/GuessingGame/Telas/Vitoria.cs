using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace GuessingGame.Telas {
    public partial class Vitoria : Form {
        public Vitoria() {
            InitializeComponent();
        }

        private void btn_ok_Click(object sender, EventArgs e) {
            Program.telaInicial.Show();
            Close();
        }

        private void Vitoria_Load(object sender, EventArgs e) {
            this.Location = new Point(400, 200);
        }
    }
}
