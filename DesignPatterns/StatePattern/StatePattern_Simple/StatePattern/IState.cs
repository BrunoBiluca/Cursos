using System;
using System.Collections.Generic;
using System.Text;

namespace StatePattern {
    interface IState {
        void DoAction(Context context);
    }
}
