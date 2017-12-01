using System;
using System.Collections.Generic;
using System.Text;

namespace FlashStack {
    public class FlashStack {

        private int _minValue;
        private readonly Stack<int> _stack = new Stack<int>();

        public int Min() => _minValue;

        public void Push(int value) {
            if (_stack.Count == 0) {
                _minValue = value;
            } else if (value < _minValue) {
                var aux = _minValue;
                _minValue = value;
                value = 2 * value - aux;
            }

            _stack.Push(value);
        }

        public int Pop() {
            var value = _stack.Pop();

            if (value >= _minValue) return value;

            var result = _minValue;

            _minValue = 2 * _minValue - value;

            return result;
        }

    }
}
