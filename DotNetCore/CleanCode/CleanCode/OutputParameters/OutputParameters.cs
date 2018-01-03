using CleanCode.Comments;
using System;
using System.Collections.Generic;

namespace CleanCode.OutputParameters
{
    public class OutputParameters
    {
        public void DisplayCustomers()
        {
            int totalCount = 0;
            var customers = GetCustomers(1, out totalCount);

            Console.WriteLine("Total customers: " + totalCount);
            foreach (var c in customers)
                Console.WriteLine(c);
        }

        public IEnumerable<Customer> GetCustomers(int pageIndex, out int totalCount)
        {
            totalCount = 100;
            return new List<Customer>();
        }
    }
}
