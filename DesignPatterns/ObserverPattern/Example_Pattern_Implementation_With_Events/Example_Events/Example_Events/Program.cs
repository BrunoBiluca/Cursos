using System;

namespace Example_Events {
    class Program {
        static void Main(string[] args) {

            Entity player = new Entity(true);
            Console.WriteLine($"Player is on Bridge in X: {player.X} and Y: {player.Y}");

            Physics.OnStateChange += Achievements.OnNotify;
            Physics.UpdateEntity(player);

            Console.WriteLine($"Player is off Bridge in X: {player.X} and Y: {player.Y}");

            Console.ReadKey();
        }
    }
}
