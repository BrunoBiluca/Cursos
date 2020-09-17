using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.Windows.Forms;
using GuessingGame.Classes;
using GuessingGame.Telas;

namespace GuessingGame {
    static class Program {
        /// <summary>
        /// The main entry point for the application.
        /// </summary>

        public static BancoAnimais ba;
        public static Form1 telaInicial;

        [STAThread]
        static void Main() {
            Application.EnableVisualStyles();
            Application.SetCompatibleTextRenderingDefault(false);

            ba = new BancoAnimais();

            telaInicial = new Form1();

            Application.Run(telaInicial);
        }
    }
}
