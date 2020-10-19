using System;
using System.Collections.Generic;
using System.Text;

namespace Challenges {
    public class LetsReviewChallenge {
        public static void PrintEvenOddIndexedCharacters() {
            var inputSize = int.Parse(Console.In.ReadLine());

            for(var i = 0; i < inputSize; i++){
                var line = Console.In.ReadLine();

                for(var charIdx = 0; charIdx < line.Length; charIdx += 2){
                    Console.Write(line[charIdx]);
                }
                Console.Write(" ");
                for(var charIdx = 1; charIdx < line.Length; charIdx += 2){
                    Console.Write(line[charIdx]);
                }
                Console.WriteLine();
            }
        }
    }
}
