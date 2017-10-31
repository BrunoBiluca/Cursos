using System;
using System.Collections.Generic;
using System.Text;

namespace StatePattern {
    /// <summary>
    /// Classe Context gerencia o estado do objeto que queremos mapear
    /// </summary>
    class Context {
        private IState State;

        public Context() {
            State = null;
        }

        public IState GetState() {
            return State;
        }

        public void SetState(IState state) {
            State = state;
        }
    }
}
