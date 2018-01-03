using System;

namespace CleanCode.Tuples
{
    public class Tuples
    {
        public Tuple<int, int> GetDueBillsCount(int pageIndex)
        {
            // Some logic
            // ...
            var totalDue = 0;
            var totalOverDue = 0;

            return new Tuple<int, int>(totalDue, totalOverDue);
        }

        public void DisplayCustomers()
        {
            var dueBillsCount = GetDueBillsCount(1);
            Console.WriteLine(dueBillsCount.Item1);
            Console.WriteLine(dueBillsCount.Item2);
        }
    }
}
