using System;
using System.Collections.Generic;
using System.IO;
class Solution {
    
    static bool IsPrime(int value){
        if(value == 1) return false;
        
        // Só é necessário verificar até a raiz quadrada no número,
        //  já que todo inteiro que não é primo tem a sua raiz quadrada como divisor
        for(var i = 2; i <= (int)Math.Sqrt(value); i++){
            if(value % i == 0){
                return false;
            }
        }
        return true;
    }
    
    static void Main(String[] args) {
        var n = int.Parse(Console.ReadLine());
        
        for(var i = 0; i < n; i++){
            var testNumber = int.Parse(Console.ReadLine());
            
            if(IsPrime(testNumber)){
                Console.WriteLine("Prime");
            }
            else {
                Console.WriteLine("Not prime");
            }
        }
    }
}
