using Microsoft.VisualStudio.TestTools.UnitTesting;
using Exemplo_Undo_Redo;

namespace Exemplo_Undo_Redo_Tests {
    [TestClass]
    public class DocumentTests {

        Document document = new Document();
        string text = "texto teste";
        string text2 = "outro teste";

        [TestMethod]
        public void AppendSimpleText() {
            document.AppendText(text);

            Assert.IsTrue(document.Text.Equals(text));
            Assert.IsTrue(document.Size.Equals(text.Length));
        }

        [TestMethod]
        public void AppendTwoTexts() {
            document.AppendText(text);
            document.AppendText(text2);
            Assert.IsTrue(document.Text.Equals(text+text2));
            Assert.IsTrue(document.Size.Equals(text.Length+text2.Length));
        }

        [TestMethod]
        public void RemoveSimpleText() {
            document.AppendText(text);
            document.AppendText(text2);
            document.RemoveText(text2);

            Assert.IsTrue(document.Text.Equals(text));
            Assert.IsTrue(document.Size.Equals(text.Length));
        }
        
        [TestMethod]
        public void SetSimpleText() {
            document.SetText(text);

            Assert.IsTrue(document.Text.Equals(text));
            Assert.IsTrue(document.Size.Equals(text.Length));
        }

    }
}
