using System;

namespace Exemplo_Undo_Redo {
    public class AppendTextCommand: ICommand {

        private string TextBefore;
        private string Text;
        Document Document;

        public AppendTextCommand(Document document, string text) {
            TextBefore = "";
            Document = document;
            Text = text;
        }

        public void Execute() {
            TextBefore = Text;
            Document.AppendText(Text);
        }

        public void Redo() {
            Document.AppendText(Text);
        }

        public void Undo() {
            Document.RemoveText(Text);
        }
    }
}
