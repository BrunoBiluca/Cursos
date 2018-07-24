using System;

  namespace Coding.Exercise {
    public class Bird {
      public int Age { get; set; }
      
      public string Fly() {
        return (Age < 10) ? "flying" : "too old";
      }
    }

    public class Lizard {
      public int Age { get; set; }
      
      public string Crawl() {
        return (Age > 1) ? "crawling" : "too young";
      }
    }

  // Neste exemplo implementamos uma classe que é decorada por outros tipos de animais.
  // O padrão decorator funciona com uma referencia para cada classe que está decorando.
  // Assim o métodos das classe que decoram a outra são extendidos.
  
  // Podemos também utilizar interface para garantir essa extensão dos métodos.
    public class Dragon{
        
        Lizard lizard = new Lizard();
        Bird bird = new Bird();

        private int _age;
      public int Age
      {
        get{return this._age;}
        set {this._age = value;}
      }

      public string Fly()
      {
          bird.Age = _age;
        return bird.Fly();
      }

      public string Crawl()
      {
          lizard.Age = _age;
        return lizard.Crawl();
      }
    }
  }
