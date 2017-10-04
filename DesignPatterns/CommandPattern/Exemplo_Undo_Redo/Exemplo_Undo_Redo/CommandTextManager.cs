using System;
using System.Collections.Generic;

namespace Exemplo_Undo_Redo {
    public class CommandTextManager {

        private List<ICommand> Commands = new List<ICommand>();
        private int IndexLastCommand { get{ return Commands.Count - 1; } }
        private int indexCurrentCommand = 0;

        public int SizeCommands { get { return Commands.Count; } }

        public void TakeCommand(ICommand command) {

            RemoveObsoleteCommand();
            
            Commands.Add(command);
            indexCurrentCommand = IndexLastCommand;

            command.Execute();
        }

        public void UndoCommand() {
            if (indexCurrentCommand < 0) return;

            ICommand lastCommand = Commands[indexCurrentCommand];
            lastCommand.Undo();
            indexCurrentCommand--;
        }

        public void RedoCommand() {
            if (indexCurrentCommand == IndexLastCommand) return;

            indexCurrentCommand++;
            ICommand lastCommand = Commands[indexCurrentCommand];
            lastCommand.Redo();
        }

        private void RemoveObsoleteCommand() {
            if (IndexLastCommand - indexCurrentCommand <= 0) return;

            Commands.RemoveRange(indexCurrentCommand + 1, IndexLastCommand - indexCurrentCommand);
        }

    }
}
