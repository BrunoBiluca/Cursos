using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Box {

    GameObject BoxObj;
    BoxEvent BoxEvent;

    public Box(GameObject boxObj, BoxEvent boxEvent) {
        BoxObj = boxObj;
        BoxEvent = boxEvent;
    }

    public void NotifyJump() {
        Jump(BoxEvent.GetJumpForce());
    }

    private void Jump(float jumpForce) {
        if(BoxObj.transform.position.y < 0.55f) {
            BoxObj.GetComponent<Rigidbody>().AddForce(Vector3.up * jumpForce);
        }
    }

}
