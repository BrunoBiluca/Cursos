using System;
using System.Collections;
using System.Collections.Generic;

  namespace Coding.Exercise {
      // Fiz a interface entre as duas classes eu crio a compatibilidade 
      // Dessa forma podemos garantir que todas as classes que implementam a interface IValueContainer serão compatíveis
    public interface IValueContainer : IEnumerable<int>{
    }

    public class SingleValue : IValueContainer {
      public int Value {get; set;}

        public IEnumerator GetEnumerator() {
            yield return Value;
        }

        IEnumerator<int> IEnumerable<int>.GetEnumerator()
        {
            yield return Value;
        }
    }

    public class ManyValues : List<int>, IValueContainer {
      
    }

    public static class ExtensionMethods {
      public static int Sum(this List<IValueContainer> containers) {
        int result = 0;
        foreach (var c in containers)
        foreach (var i in c)
          result += i;
        return result;
      }
    }
  }
