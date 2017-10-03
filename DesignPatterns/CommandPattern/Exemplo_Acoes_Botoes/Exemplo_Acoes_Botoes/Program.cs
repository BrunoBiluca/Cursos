using System;
using System.Threading;

namespace Exemplo_Acoes_Botoes {
    class Program {
        static void Main(string[] args) {

            // Config dos botões
            // Podemos alterar os comandos dos inputs em tempo de execução
            //JumpCommand jump = new JumpCommand();
            //FireCommand fire = new FireCommand();
            //InputHandler.SetInputAction(BUTTONS.BUTTON_X, jump);
            //InputHandler.SetInputAction(BUTTONS.BUTTON_SQUARE, fire);

            string ator = "Ryu";

            // Game Loop
            while(true) {

                // Retorna um valor aleatório do enum
                // Simula o pressionar do botão a cada frame
                Array values = Enum.GetValues(typeof(BUTTONS));
                Random random = new Random();
                BUTTONS randomButton = (BUTTONS)values.GetValue(random.Next(values.Length));

                ICommand command = InputHandler.HandleInput(randomButton);
                if(command != null) {
                    command.Execute(ator);
                }

                string line = Console.ReadLine();
                if (line == "exit"){
                    break;
                }
            }
        }
    }
}
