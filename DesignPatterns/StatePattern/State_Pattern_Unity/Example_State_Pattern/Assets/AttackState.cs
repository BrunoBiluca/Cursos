using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using UnityEngine;

namespace Assets {
    class AttackState : IEnemyState, ISkeletonState {
        public IEnemyState Handle(Enemy enemy, Transform playerObj) {

            var distance = (enemy.EnemyObj.position - playerObj.position).magnitude;

            Debug.Log("Enemy Attack State");

            if(enemy.Health < 20f) {
                return new FleeState();
            }

            if(distance > 2f) {
                return new MoveTowardsState();
            }

            return this;
        }

        public IEnemyState Handle(Skeleton enemy, Transform playerObj) {
            var distance = (enemy.EnemyObj.position - playerObj.position).magnitude;

            Debug.Log("Skeleton Attack State");
            
            if(enemy.Health < 20f) {
                return new FleeState();
            }

            if(distance > 6f) {
                return new MoveTowardsState();
            }

            return this;
        }

        public void Update(Enemy enemy, Transform playerObj) {
            
        }
    }
}
