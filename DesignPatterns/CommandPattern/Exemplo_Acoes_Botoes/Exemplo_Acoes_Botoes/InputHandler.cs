using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Acoes_Botoes {

    /// <summary>
    /// Botões utilizados
    /// </summary>
    public enum BUTTONS {
        BUTTON_X,
        BUTTON_SQUARE,
        BUTTON_CIRCLE
    };

    public static class InputHandler {

        private static ICommand button_x = new JumpCommand();
        private static ICommand button_square = new FireCommand();
        private static ICommand button_circle = new NullCommand();

        /// <summary>
        /// Indentifica o botão que foi pressionado e retorna o comando correspondente
        /// </summary>
        /// <param name="pressedButton"></param>
        /// <returns></returns>
        public static ICommand HandleInput(BUTTONS pressedButton) {
            if (pressedButton.Equals(BUTTONS.BUTTON_X)) return button_x;
            else if (pressedButton.Equals(BUTTONS.BUTTON_SQUARE)) return button_square;
            else if (pressedButton.Equals(BUTTONS.BUTTON_CIRCLE)) return button_circle;

            return null;
        }

        /// <summary>
        /// Seta o commando ao botão responsável por executar a ação
        /// </summary>
        /// <param name="button"></param>
        /// <param name="command"></param>
        public static void SetInputAction(BUTTONS button, ICommand command) {
            switch (button) {
                case BUTTONS.BUTTON_X:
                    button_x = command;
                    break;
                case BUTTONS.BUTTON_SQUARE:
                    button_square = command;
                    break;
                case BUTTONS.BUTTON_CIRCLE:
                    button_circle = command;
                    break;
            }
        }

        private static bool IsPressed(BUTTONS button) {
            switch (button) {
                case BUTTONS.BUTTON_X:
                case BUTTONS.BUTTON_SQUARE:
                case BUTTONS.BUTTON_CIRCLE:
                    return true;
            }

            return false;
        }
    }
}
