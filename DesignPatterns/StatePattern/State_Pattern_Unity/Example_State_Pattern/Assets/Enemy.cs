using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public abstract class Enemy {

    protected Transform EnemyObj;

    protected enum EnemyFSM {
        Attack,
        Flee,
        Stroll,
        MoveTowardsPlayer
    }

    public abstract void Update(Transform playerObj);

    protected void DoAction(Transform playerObj, EnemyFSM enemyMode) {
        float fleeSpeed = 10f;
        float strollSpeed = 1f;
        float attackSpeed = 5f;

        switch(enemyMode) {
            case EnemyFSM.Attack:
                break;
            case EnemyFSM.Flee:
                EnemyObj.rotation = Quaternion.LookRotation(EnemyObj.position - playerObj.position);
                EnemyObj.Translate(EnemyObj.forward * fleeSpeed * Time.deltaTime);
                break;
            case EnemyFSM.Stroll:
                Vector3 randomPos = new Vector3(Random.Range(0, 10), 0f, Random.Range(0, 10));
                EnemyObj.rotation = Quaternion.LookRotation(EnemyObj.position - randomPos);
                EnemyObj.Translate(randomPos * strollSpeed * Time.deltaTime);
                break;
            case EnemyFSM.MoveTowardsPlayer:
                EnemyObj.rotation = Quaternion.LookRotation(playerObj.position - EnemyObj.position);
                EnemyObj.Translate(EnemyObj.forward * attackSpeed * Time.deltaTime);
                break;
            default:
                break;
        }
    }

}
