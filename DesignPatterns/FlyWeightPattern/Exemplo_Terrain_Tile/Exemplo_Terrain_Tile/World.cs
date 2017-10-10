using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Terrain_Tile {
    class World {

        private ITerrain GrassTerrain;
        private ITerrain RiverTerrain;
        private ITerrain HillTerrain;

        private ITerrain[,] Tiles; // 2D array
        private int Width;
        private int Height;
        private Random rand = new Random();

        public World(int width, int height) {

            GrassTerrain = TerrainFactory.GetTerrain(EnumTextures.GRASS);
            RiverTerrain = TerrainFactory.GetTerrain(EnumTextures.RIVER);
            HillTerrain = TerrainFactory.GetTerrain(EnumTextures.HILL);
            Width = width;
            Height = height;

            Tiles = new ITerrain[width, height];
            // Fill the ground with grass.
            for (int i = 0; i < width; i++) {
                for (int y = 0; y < height; y++) {
                    // Sprinkle some hills.
                    if (rand.Next(3) % 3 == 0) {
                        Tiles[i, y] = HillTerrain;
                    } else {
                        Tiles[i, y] = GrassTerrain;
                    }
                }
            }

            // Lay a river.
            int x = rand.Next(width);
            for (int y = 0; y < height; y++) {
                Tiles[x, y] = RiverTerrain;
            }
        }

        public ITerrain GetTile(int x, int y) {
            return Tiles[x, y];
        }

        public override string ToString() {

            string str = "";

            for(int x = 0; x < Width; x++) {
                for(int y = 0; y < Height; y++) {
                    str += Tiles[x, y].GetTexture();
                }
                str += "\n";
            }

            return str;
        }
    }
}
