using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using UnityEngine;

namespace Assets {
    public class MoveTowardsState : IEnemyState {
        public IEnemyState Handle(Enemy enemy, Transform playerObj) {
            var distance = (enemy.EnemyObj.position - playerObj.position).magnitude;

            if(distance < 5f) {
                return new AttackState();
            }

            if(distance > 15f) {
                return new StrollState();
            }

            return this;
        }

        public void Update(Enemy enemy, Transform playerObj) {
            enemy.EnemyObj.rotation = Quaternion.LookRotation(playerObj.position - enemy.EnemyObj.position);
            enemy.EnemyObj.Translate(enemy.EnemyObj.forward * enemy.MoveTowardsSpeed * Time.deltaTime);
        }
    }
}
