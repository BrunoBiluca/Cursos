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
    public partial class Adicionar_animal : Form {
        private Caracteristica caracteristica;

        public Adicionar_animal() {
            InitializeComponent();
        }

        public Adicionar_animal(Caracteristica caracteristica) {
            this.caracteristica = caracteristica;
            InitializeComponent();
        }

        private void btn_ok_Click(object sender, EventArgs e) {
            var novoAnimal = textbox_animal.Text;

            Adicionar_caracteristica add_caracteristica = new Adicionar_caracteristica(novoAnimal ,caracteristica);
            add_caracteristica.StartPosition = FormStartPosition.CenterParent;
            add_caracteristica.Show();
            Close();
        }

        private void Adicionar_animal_Load(object sender, EventArgs e) {
            this.Location = new Point(400, 200);
        }
    }
}
