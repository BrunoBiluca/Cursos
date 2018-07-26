using System;
using System.Collections.Generic;
using System.Text;

namespace Coding.Exercise {
    public class Sentence {
        private string[] words;
        private Dictionary<int, WordToken> tokens = new Dictionary<int, WordToken>();
        
      public Sentence(string plainText) {
          this.words = plainText.Split(' ');
      }


        // Só é instanciado um WordToken se a posição for chamada
        // Aqui economizamos memória
      public WordToken this[int index] {
        get {
          WordToken wt = new WordToken();
          tokens.Add(index, wt);
          return tokens[index];
        }
      }

      public override string ToString() {
        var result = new List<string>();
        for(int i = 0; i < words.Length; i++){
            // Tenho que garantir que a chave exite, porque ela só é criada quando é chamado
            if(tokens.ContainsKey(i) && tokens[i].Capitalize) result.Add(words[i].ToUpper());
            else result.Add(words[i]);
        }
        return string.Join(" ", result);
      }

      public class WordToken {
        public bool Capitalize;
      }
    }
  }
