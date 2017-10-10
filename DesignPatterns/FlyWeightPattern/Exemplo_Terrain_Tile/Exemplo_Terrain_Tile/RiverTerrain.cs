using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Terrain_Tile {
    class RiverTerrain : ITerrain{
        private int MovementCost;
        private bool IsWater;
        /// <summary>
        /// Atributo que simula uma textura
        /// </summary>
        private EnumTextures Texture;

        public RiverTerrain() {
            MovementCost = 3;
            IsWater = true;
            Texture = EnumTextures.RIVER;
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
