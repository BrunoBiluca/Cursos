using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class GameController : MonoBehaviour {

    [SerializeField]
    GameObject SphereObj;

    public int direction = 1;
    public float speed = 1.0f;
    public float time = 0f;

    [SerializeField]
    GameObject Box1Obj;
    [SerializeField]
    GameObject Box2Obj;
    [SerializeField]
    GameObject Box3Obj;

    public delegate void SpherePositionChange();
    public event SpherePositionChange OnChange;

    // Use this for initialization
    void Start() {

        SphereObj.transform.position = new Vector3(0, 0, -9);

        Box box1 = new Box(Box1Obj, new JumpLittle());
        Box box2 = new Box(Box2Obj, new JumpMiddle());
        Box box3 = new Box(Box3Obj, new JumpHigh());

        OnChange += box1.NotifyJump;
        OnChange += box2.NotifyJump;
        OnChange += box3.NotifyJump;
    }

    // Update is called once per frame
    void Update() {

        time += Time.deltaTime;
        if(time > 0.5f) {
            SphereObj.transform.position = new Vector3(SphereObj.transform.position.x,
                                                        SphereObj.transform.position.y,
                                                        SphereObj.transform.position.z + (direction * speed));
            time = 0f;

            if(SphereObj.transform.position.z == -10 || SphereObj.transform.position.z == 10) {
                direction *= -1;
            }
        }

        if(SphereObj.transform.position.magnitude < 0.5f) {
            OnChange();
        }
    }
}
