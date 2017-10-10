using System;
using System.Collections.Generic;
using System.Text;

namespace Exemplo_Terrain_Tile {

    interface ITerrain {
        int GetMovementCost();
        bool IsWater();
        string GetTexture();
    }
}
