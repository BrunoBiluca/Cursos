using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Creeper : Enemy {

    EnemyFSM CreeperMode = EnemyFSM.Stroll;

    float Health = 100f;


    public Creeper(Transform creeperObj) {
        base.EnemyObj = creeperObj;
    }

    public override void Update(Transform playerObj) {
        //The distance between the Creeper and the player
        float distance = (base.EnemyObj.position - playerObj.position).magnitude;

        switch(CreeperMode) {
            case EnemyFSM.Attack:
                if(Health < 20f) {
                    CreeperMode = EnemyFSM.Flee;
                } else if(distance > 2f) {
                    CreeperMode = EnemyFSM.MoveTowardsPlayer;
                }
                break;
            case EnemyFSM.Flee:
                if(Health > 60f) {
                    CreeperMode = EnemyFSM.Stroll;
                }
                break;
            case EnemyFSM.Stroll:
                if(distance < 10f) {
                    CreeperMode = EnemyFSM.MoveTowardsPlayer;
                }
                break;
            case EnemyFSM.MoveTowardsPlayer:
                if(distance < 1f) {
                    CreeperMode = EnemyFSM.Attack;
                } else if(distance > 15f) {
                    CreeperMode = EnemyFSM.Stroll;
                }
                break;
        }

        //Move the enemy based on a state
        DoAction(playerObj, CreeperMode);

    }
}
