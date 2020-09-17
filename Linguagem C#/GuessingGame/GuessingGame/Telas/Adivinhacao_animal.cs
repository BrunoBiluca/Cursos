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
    public partial class Adivinhacao_animal : Form {
        private Caracteristica caracteristica;

        public Adivinhacao_animal() {
            InitializeComponent();
        }

        public Adivinhacao_animal(Caracteristica caracteristica) {
            this.caracteristica = caracteristica;
            InitializeComponent();
        }

        private void Adivinhacao_animal_Load(object sender, EventArgs e) {
            label_animal.Text += caracteristica.getAnimal() + "?";
            this.Location = new Point(400, 200);
        }

        private void btn_yes_Click(object sender, EventArgs e) {
            Vitoria telaVitoria = new Vitoria();
            telaVitoria.StartPosition = FormStartPosition.CenterParent;
            telaVitoria.Show();
            Close();
        }

        private void btn_no_Click(object sender, EventArgs e) {
            Adicionar_animal add_animal = new Adicionar_animal(caracteristica);
            add_animal.StartPosition = FormStartPosition.CenterParent;
            add_animal.Show();
            Close();
        }
    }
}
