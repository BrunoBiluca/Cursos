using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Terrain_Tile {
    class GrassTerrain : ITerrain{
        private int MovementCost;
        private bool IsWater;
        /// <summary>
        /// Atributo que simula uma textura
        /// </summary>
        private EnumTextures Texture;

        public GrassTerrain() {
            MovementCost = 1;
            IsWater = false;
            Texture = EnumTextures.GRASS;
        }

        public int GetMovementCost() {
            return MovementCost;
        }

        public string GetTexture() {
            return Texture.ToString();
        }

        bool ITerrain.IsWater() {
            return IsWater;
        }
    }
}
