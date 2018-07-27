using System;

  namespace Coding.Exercise {

      public interface IPerson {
          int Age{get; set;}
          string Drink();
          string Drive();
          string DrinkAndDrive();
      }

    public class Person : IPerson{
      public int Age { get; set; }

      public string Drink() {
        return "drinking";
      }

      public string Drive() {
        return "driving";
      }

      public string DrinkAndDrive() {
        return "driving while drunk";
      }
    }

    public class ResponsiblePerson : IPerson {

        private readonly IPerson person;
        public int Age {
            get{ return person.Age; } 
            set{ this.person.Age = value; }
        }

      public ResponsiblePerson(Person person) {
        this.person = person;
      }

        public string Drink() {
            if(Age < 18) return "too young";
            
            return person.Drink();
        }

        public string DrinkAndDrive() {
            return "dead";
        }

        public string Drive() {
            if(Age < 16) return "too young";
            
            return person.Drive();
        }
    }
  }
