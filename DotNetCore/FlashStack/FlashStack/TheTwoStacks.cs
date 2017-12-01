using System;
using System.Collections.Generic;
using System.Text;

namespace FlashStack {
    public class TheTwoStacks {

        private Stack<int> stackWhite = new Stack<int>();
        private Stack<int> stackBlack = new Stack<int>();

        public void Push(int value) {
            
            stackBlack.Push(value);

            if (stackWhite.Count == 0) {
                stackWhite.Push(value);
                return;
            }

            stackWhite.Push(value < stackWhite.Peek() ? value : stackWhite.Peek());
        }

        public int Pop() {
            stackWhite.Pop();
            return stackBlack.Pop();
        }

        public int Min() {
            return stackWhite.Peek();
        }

    }
}
