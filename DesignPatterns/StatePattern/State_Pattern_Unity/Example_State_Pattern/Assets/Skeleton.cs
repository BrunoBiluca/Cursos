using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Skeleton : Enemy {

    EnemyFSM SkeletonMode = EnemyFSM.Stroll;

    float Health = 100f;

    public Skeleton(Transform skeletonObj) {
        base.EnemyObj = skeletonObj;
    }

    public override void Update(Transform playerObj) {
        float playerDistance = (base.EnemyObj.position - playerObj.position).magnitude;

        switch(SkeletonMode) {
            case EnemyFSM.Attack:
                if(Health < 20f) SkeletonMode = EnemyFSM.Flee;
                else if(playerDistance > 6f) SkeletonMode = EnemyFSM.MoveTowardsPlayer;
                break;
            case EnemyFSM.Flee:
                if(Health > 60f) SkeletonMode = EnemyFSM.Stroll;
                break;
            case EnemyFSM.Stroll:
                if(playerDistance > 10f) SkeletonMode = EnemyFSM.MoveTowardsPlayer;
                break;
            case EnemyFSM.MoveTowardsPlayer:
                if(playerDistance < 5f) SkeletonMode = EnemyFSM.Attack;
                else if(playerDistance > 15) SkeletonMode = EnemyFSM.Stroll;
                break;
            default:
                break;
        }

        DoAction(playerObj, SkeletonMode);
    }
}
