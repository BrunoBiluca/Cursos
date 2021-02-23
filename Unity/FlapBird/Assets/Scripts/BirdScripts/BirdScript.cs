using UnityEngine;
using System.Collections;
using UnityEngine.UI;
using Assets.Scripts;
using Assets.UnityFoundation.CameraScripts;

public class BirdScript : MonoBehaviour, IFollowable {

    public static BirdScript instance;

    [SerializeField]
    private Rigidbody2D myRigidBody;

    [SerializeField]
    private Animator anim;

    private float forwardSpeed = 3f;
    private float bounceSpeed = 4f;

    private bool didFlap;
    public bool isAlive;

    private Button flapButton;

    [SerializeField]
    private AudioSource audioSource;

    [SerializeField]
    private AudioClip flapClip, pointClip, dieClip;

    public int score;

    void Awake() {
        if(instance == null)
            instance = this;

        isAlive = true;
        score = 0;

        flapButton = GameObject.FindGameObjectWithTag("FlapButton").GetComponent<Button>();
        flapButton.onClick.AddListener(() => FlapTheBird());
    }

    // Use this for initialization
    void Start() {

    }

    // Update is called once per frame
    void FixedUpdate() {
        if(isAlive) {
            Vector3 temp = transform.position;
            temp.x += forwardSpeed * Time.deltaTime;
            transform.position = temp;

            if(didFlap) {
                didFlap = false;
                myRigidBody.velocity = new Vector2(0, bounceSpeed);
                anim.SetTrigger("Flap");
                audioSource.PlayOneShot(flapClip);
            }

            if(myRigidBody.velocity.y >= 0) {
                transform.rotation = Quaternion.Euler(0, 0, 0);
            } else {
                float angle = 0;
                angle = Mathf.Lerp(0, -90, -myRigidBody.velocity.y / 7);
                transform.rotation = Quaternion.Euler(0, 0, angle);
            }

        }
    }

    public void FlapTheBird() {
        didFlap = true;
    }

    void OnCollisionEnter2D(Collision2D target) {
        if(target.gameObject.tag == "Ground" || target.gameObject.tag == "Pipe")
            if(isAlive) {
                isAlive = false;
                anim.SetTrigger("Died");
                audioSource.PlayOneShot(dieClip);
                GameplayController.instance.PlayerDiedShowScore(score);
            }
    }

    void OnTriggerEnter2D(Collider2D target) {
        if(target.tag == "PipeHolder") {
            score++;
            GameplayController.instance.SetScore(score);
            audioSource.PlayOneShot(pointClip);
        }
    }

    public Vector3 GetPosition() {
        return transform.position;
    }

    public bool StopFollow() {
        return !isAlive;
    }

    public Vector3 GetPositionOffset() {
        return new Vector3(
            Camera.main.transform.position.x - transform.position.x - 1f,
            0,
            0
        );
    }
}
