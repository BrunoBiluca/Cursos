using System;
using System.Collections.Generic;
using System.Text;

/// <summary>
/// Classe exemplo para organizar o modelo dos dados trabalhados nesse exemplo
/// </summary>
namespace Filter_Example {
    public enum Color {
        Blue,
        Green,
        Red
    }

    public enum Size {
        Small,
        Medium,
        Large
    }

    public class Product {
        public string Name;
        public Color Color;
        public Size Size;

        public Product(string name, Color color, Size size) {
            Name = name ?? throw new ArgumentNullException(paramName: nameof(name));
            Color = color;
            Size = size;
        }
    }
}
