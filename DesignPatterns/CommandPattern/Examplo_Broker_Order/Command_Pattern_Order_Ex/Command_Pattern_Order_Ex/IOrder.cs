using System;
using System.Collections.Generic;
using System.Text;

namespace Command_Pattern_Order_Ex {
    /// <summary>
    /// Interface descreve o comportamento que um classe command deve implementar
    /// </summary>
    interface IOrder {
        void Execute();
    }
}
