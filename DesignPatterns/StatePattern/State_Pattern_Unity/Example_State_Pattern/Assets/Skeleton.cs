using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using UnityEngine;

namespace Assets {
    class Skeleton : Enemy {
        public Skeleton(Transform enemyObj) : base(enemyObj) {
            State = new StrollState();
            Health = 100;
            StrollSpeed = 2f;
            FleeSpeed = 7f;
            MoveTowardsSpeed = 5f;
        }

        public override void Handle(Transform playerObj) {
            State = State.Handle(this, playerObj);
            Update(playerObj);
        }
    }
}
