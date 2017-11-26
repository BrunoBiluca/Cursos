using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using UnityEngine;

namespace Assets {
    public abstract class Enemy{

        public Transform EnemyObj { get; private set; }

        public IEnemyState State { get; protected set; }

        public float Health { get; protected set; }
        public float StrollSpeed { get; protected set; }
        public float FleeSpeed { get; protected set; }
        public float MoveTowardsSpeed { get; protected set; }

        public Enemy(Transform enemyObj) {
            EnemyObj = enemyObj;
        }

        public virtual void Handle(Transform playerObj) {
            State = State.Handle(this, playerObj);
            Update(playerObj);
        }

        public virtual void Update(Transform playerObj) {
            State.Update(this, playerObj);
        }
    }
}
