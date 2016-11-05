using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FactoryPattern {
    /// <summary>
    /// Interface, garante que todas as classes que a implementam tenham criadas seus métodos
    /// </summary>
    public interface Shape {
        string Draw();
    }
}
