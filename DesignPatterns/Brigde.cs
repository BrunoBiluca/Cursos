using System;

// Utilizando este padrão podemos ligar duas classes por meio de abstração
// Isso nos permite maior flexibilidade e reduz a quantidade de código gerado já que podemos

  namespace Coding.Exercise {
    public interface IRenderer {
        string Draw(string Name);
    }
      
    public abstract class Shape {
      public IRenderer renderer;
      public string Name { get; set; }
      
      // A referencia é interessante ser injetada pelo container de injeção de dependencia
      public Shape(IRenderer renderer){
          this.renderer = renderer;
      }
      
      public override string ToString(){
          return this.renderer.Draw(Name);
      }
    }

    public class Triangle : Shape {
      public Triangle(IRenderer renderer) : base(renderer) {
          Name = "Triangle";
      }
    }

    public class Square : Shape {
      public Square(IRenderer renderer) : base(renderer) {
          Name = "Square";
      }
    }

    public class VectorRenderer : IRenderer {
        public string Draw(string name) {
            return $"Drawing {name} as lines";
        }
    }

    public class RasterRenderer : IRenderer {
        public string Draw(string name){
            return $"Drawing {name} as pixels";
        }
    }
  }
