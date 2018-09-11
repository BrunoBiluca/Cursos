using System;

  // Devemos levar em consideração a interface que queremos resolver

  namespace Coding.Exercise{
    // Classe que deve ser adaptada
    public class Square {
      public int Side;
    }

    // Interface que devemos adaptar
    public interface IRectangle {
      int Width { get; }
      int Height { get; }
    }
    
    public static class ExtensionMethods {
      public static int Area(this IRectangle rc) {
        return rc.Width * rc.Height;
      }
    }

    // A classe adapter deve implementar a interface que queremos adaptar
    // então adequamos a classe Square para conseguir comportar como uma classe Rectangle se comportaria
    public class SquareToRectangleAdapter : IRectangle {
      public int Width {get; set;}
      public int Height {get; set;}
        
      // Podemos implementar no construtor do adapter a conversão de uma classe na que queremos adaptar
      public SquareToRectangleAdapter(Square square) {
        this.Width = square.Side;
        this.Height = square.Side;
      }
      
    }
  }
