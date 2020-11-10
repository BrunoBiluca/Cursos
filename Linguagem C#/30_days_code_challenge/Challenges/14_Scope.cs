using System;
using System.Linq;

class Difference {
    private int[] elements;
    public int maximumDifference;

    public Difference(int[] elements){
        this.elements = elements;
    }

	public void computeDifference(){       
        var maxElem = elements.Max();
        var minElem = elements.Min();
        
        maximumDifference = Math.Abs(minElem - maxElem);
    }
} // End of Difference Class

class Solution {
    static void Main(string[] args) {
        Convert.ToInt32(Console.ReadLine());
        
        int[] a = Console.ReadLine().Split(' ').Select(x=>Convert.ToInt32(x)).ToArray();
        
        Difference d = new Difference(a);
        
        d.computeDifference();
        
        Console.Write(d.maximumDifference);
    }
}
