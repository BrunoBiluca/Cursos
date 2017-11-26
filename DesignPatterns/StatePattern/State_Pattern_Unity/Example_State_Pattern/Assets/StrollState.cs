using UnityEngine;

namespace Assets {
    class StrollState : IEnemyState {
        public IEnemyState Handle(Enemy enemy, Transform playerObj) {
            var distance = (enemy.EnemyObj.position - playerObj.position).magnitude;
            
            if(distance < 10f) {
                return new MoveTowardsState();
            }

            return this;
        }

        public void Update(Enemy enemy, Transform playerObj) {
            Vector3 randomPos = new Vector3(Random.Range(0f, 100f), 0f, Random.Range(0f, 100f));
            enemy.EnemyObj.rotation = Quaternion.LookRotation(enemy.EnemyObj.position - randomPos);
            enemy.EnemyObj.Translate(enemy.EnemyObj.forward * enemy.StrollSpeed * Time.deltaTime);
        }
    }
}
