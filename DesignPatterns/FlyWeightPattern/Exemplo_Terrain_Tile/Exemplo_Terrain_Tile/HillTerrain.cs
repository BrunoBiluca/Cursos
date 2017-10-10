using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Terrain_Tile {
    class HillTerrain: ITerrain {

        private int MovementCost;
        private bool IsWater;
        /// <summary>
        /// Atributo que simula uma textura
        /// </summary>
        private EnumTextures Texture;

        public HillTerrain() {
            MovementCost = 2;
            IsWater = false;
            Texture = EnumTextures.HILL;
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
