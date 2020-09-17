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
    public partial class Adicionar_caracteristica : Form {
        private Caracteristica caracteristica;
        private string novoAnimal;

        public Adicionar_caracteristica() {
            InitializeComponent();
        }

        public Adicionar_caracteristica(string novoAnimal, Caracteristica caracteristica) {
            this.novoAnimal = novoAnimal;
            this.caracteristica = caracteristica;
            InitializeComponent();
        }

        private void Adicionar_caracteristica_Load(object sender, EventArgs e) {
            this.Location = new Point(400, 200);

            var str1 = "A ";
            var str2 = " __________ but a ";
            var str3 = " does not(Fill it with a animal trait, like ";
            var str4 = " ).";

            label_add_caracteristica.Text = str1 + novoAnimal + str2
                                            + caracteristica.getAnimal() + str3 
                                            + caracteristica.getDica() + str4;
        }

        private void btn_ok_Click(object sender, EventArgs e) {
            var novaDica = textBox_add_dica.Text;

            Caracteristica novaCaracteristica = new Caracteristica(novaDica, novoAnimal);
            caracteristica.lista.Add(novaCaracteristica);

            Program.telaInicial.Show();
            Close();
        }


    }
}
