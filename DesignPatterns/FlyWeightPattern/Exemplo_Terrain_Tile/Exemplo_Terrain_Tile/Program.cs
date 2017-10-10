using System;

namespace Exemplo_Terrain_Tile {
    class Program {
        static void Main(string[] args) {
            Random rand = new Random();
            World map = new World(10, 10);
            int x = 2;
            int y = 2;
            int dice = 1;
            // Game Loop
            while(true) {
                dice = rand.Next(6);
                Console.WriteLine($"Você jogou {dice}");

                x += dice;
                if(x > 9) {
                    x = x - 9;
                    y++;
                }
                if(y > 9) {
                    Console.WriteLine("Você venceu o jogo");
                } else {
                    Console.WriteLine($"World tile - Texture: {map.GetTile(x,y).GetTexture()} and cost to move {map.GetTile(x,y).GetMovementCost()}");
                }
                
                string line = Console.ReadLine();

                if (line == "map") Console.Write(map.ToString());

                if (line == "exit"){
                    break;
                }
            }
        }
    }
}
