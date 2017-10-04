using Exemplo_Undo_Redo;
using Microsoft.VisualStudio.TestTools.UnitTesting;

namespace Exemplo_Undo_Redo_Tests {
    [TestClass]
    public class CommandTextManagerTests {

        CommandTextManager manager = new CommandTextManager();
        Document document = new Document();
        string text = "texto exemplo";

        [TestMethod]
        public void AddNewCommand() {
            manager.TakeCommand(new AppendTextCommand(document, text));

            Assert.IsTrue(manager.SizeCommands == 1);
        }

        [TestMethod]
        public void CallUndoCommandAndTakeAnotherCommand() {
            manager.TakeCommand(new AppendTextCommand(document, text));
            manager.UndoCommand();
            manager.TakeCommand(new AppendTextCommand(document, text));

            Assert.IsTrue(manager.SizeCommands == 1);
        }

        [TestMethod]
        public void CallUndo2TimesAndTakeAnotherCommand() {
            manager.TakeCommand(new AppendTextCommand(document, text));
            manager.UndoCommand();
            manager.UndoCommand();
            manager.TakeCommand(new AppendTextCommand(document, text));

            Assert.IsTrue(manager.SizeCommands == 1);
        }

        [TestMethod]
        public void CallUndoAndRedoAndTakeAnotherCommand() {
            manager.TakeCommand(new AppendTextCommand(document, text));
            manager.UndoCommand();
            manager.RedoCommand();
            manager.TakeCommand(new AppendTextCommand(document, text));

            Assert.IsTrue(manager.SizeCommands == 2);
        }

    }
}
