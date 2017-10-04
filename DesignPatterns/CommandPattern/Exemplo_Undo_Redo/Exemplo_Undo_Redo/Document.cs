namespace Exemplo_Undo_Redo {
    public class Document {
        public string Text { get; private set; }
        public int Size { get { return Text.Length; } }

        public Document() {
            Text = "";
        }

        public void AppendText(string text) {
            Text += text;
        }

        public void RemoveText(string text) {
            int indexToRemove = Size - text.Length;
            if (indexToRemove < 0) return;
            Text = Text.Remove(Size - text.Length);
        }

        public void SetText(string text) {
            Text = text;
        }
    }
}
