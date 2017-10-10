using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Terrain_Tile {

    public enum EnumTextures {
        GRASS,
        RIVER,
        HILL
    }

    class TerrainFactory {

        public static ITerrain GetTerrain(EnumTextures terrain) {
            if (terrain == EnumTextures.GRASS) {
                return new GrassTerrain();
            } else if (terrain == EnumTextures.RIVER) {
                return new RiverTerrain();
            } else if (terrain == EnumTextures.HILL) {
                return new HillTerrain();
            }
            return null;
        }

    }
}
