using System;

namespace Exemplo_Undo_Redo {
    class Program {
        static void Main(string[] args) {

            Document document = new Document();
            CommandTextManager manager = new CommandTextManager();

            while (true) {

                Console.WriteLine("TEXTO:");
                Console.WriteLine(document.Text);

                string input = Console.ReadLine();
                switch (input) {
                    case "redo":
                        manager.RedoCommand();
                        break;
                    case "undo":
                        manager.UndoCommand();
                        break;
                    case "exit":
                        return;
                    default:
                        manager.TakeCommand(new AppendTextCommand(document, input));
                        break;
                }
            }
        }
    }
}
