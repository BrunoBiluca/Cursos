using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using UnityEngine;

namespace Assets {
    class Creeper : Enemy {
        public Creeper(Transform enemyObj) : base(enemyObj) {
            State = new StrollState();
            Health = 80;
            StrollSpeed = 2f;
            FleeSpeed = 7f;
            MoveTowardsSpeed = 5f;
        }
    }
}
