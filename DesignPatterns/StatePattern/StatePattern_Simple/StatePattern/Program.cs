using System;

namespace StatePattern {
    class Program {
        static void Main(string[] args) {
            // Defino o objeto que irá controlar o estado
            Context context = new Context();

            StartState start = new StartState();
            start.DoAction(context);
            Console.WriteLine(context.GetState().ToString());

            StopState stop = new StopState();
            stop.DoAction(context);
            Console.WriteLine(context.GetState().ToString());

            Console.ReadKey();
        }
    }
}
