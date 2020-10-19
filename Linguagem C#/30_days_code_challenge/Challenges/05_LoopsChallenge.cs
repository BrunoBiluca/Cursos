using System;

namespace Challenges {
    public class LoopsChallenge {
        public static void WriteFirst10Multipliers(int n) {
            for(int i = 1; i < 10; i++) {
                Console.WriteLine($"{n} x {i} = {n * i}");
            }
            Console.Write($"{n} x 10 = {n * 10}");
        }
    }
}
