using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class GameManager : MonoBehaviour {

    private BoardManager BoardScript;

    private int level = 1;

	// Use this for initialization
	void Awake () {
        BoardScript = GetComponent<BoardManager>();
        InitGame();
	}

    void InitGame() {
        BoardScript.SetupScene(level);
    }
	
	// Update is called once per frame
	void Update () {
		
	}
}
