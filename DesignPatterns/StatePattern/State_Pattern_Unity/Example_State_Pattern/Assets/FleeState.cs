using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using UnityEngine;

namespace Assets {
    public class FleeState : IEnemyState {
        public IEnemyState Handle(Enemy enemy, Transform playerObj) {
            if(enemy.Health > 60f) {
                return new StrollState();
            }

            return this;
        }

        public void Update(Enemy enemy, Transform playerObj) {
            enemy.EnemyObj.rotation = Quaternion.LookRotation(enemy.EnemyObj.position - playerObj.position);
            enemy.EnemyObj.Translate(enemy.EnemyObj.forward * enemy.FleeSpeed * Time.deltaTime);
        }
    }
}
