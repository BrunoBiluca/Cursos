using System;
using System.Collections.Generic;
using System.Text;

namespace StatePattern {
    class StopState : IState{
        public void DoAction(Context context) {
            Console.WriteLine("Player is in Stop State");
            context.SetState(this);
        }

        public override string ToString() {
            return "Stop State";
        }
    }
}
