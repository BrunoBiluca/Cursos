using System;
using System.Collections.Generic;
using System.Text;

namespace Shape_Prototype_Example {
    // Para gerar um clone é necessário implementar a interface iCloneable
    public abstract class Shape : ICloneable {

        public int Id { get; set; }
        public string Type { get; protected set; }

        public abstract void Draw();

        public object Clone() {
            return this.MemberwiseClone();
        }
    }
}
