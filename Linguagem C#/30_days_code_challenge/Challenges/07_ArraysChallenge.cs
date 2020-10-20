using System;
using System.Linq;

namespace Challenges {
    public class ArraysChallenge {
        public static void Main() {
            int n = Convert.ToInt32(Console.ReadLine());

            int[] arr = Array.ConvertAll(
                Console.ReadLine().Split(' '),
                arrTemp => Convert.ToInt32(arrTemp)
            );

            var result = string.Join(" ", arr.Reverse());
            Console.WriteLine(result);
        }
    }
}
