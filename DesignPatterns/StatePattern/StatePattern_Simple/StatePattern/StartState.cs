using System;
using System.Collections.Generic;
using System.Text;

namespace StatePattern {
    /// <summary>
    /// Classes responsáveis para a mudança de estado
    /// </summary>
    class StartState : IState {
        public void DoAction(Context context) {
            Console.WriteLine("Player is in Start State");
            context.SetState(this);
        }

        public override string ToString() {
            return "Start State";
        }
    }
}
