using Assets;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class GameController : MonoBehaviour {

    public GameObject PlayerObj;
    public GameObject SkeletonObj;
    public GameObject CreeperObj;

    List<Enemy> Enemies = new List<Enemy>();

	// Use this for initialization
	void Start () {
        Enemies.Add(new Skeleton(SkeletonObj.transform));
        Enemies.Add(new Creeper(CreeperObj.transform));
	}
	
	// Update is called once per frame
	void Update () {
		foreach(var e in Enemies) {
            e.Handle(PlayerObj.transform);
        }
	}
}
