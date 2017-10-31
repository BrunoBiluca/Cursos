using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Random = UnityEngine.Random;

public class BoardManager : MonoBehaviour {

    [Serializable]
    public class Count {
        public int Minimum;
        public int Maximum;

        public Count(int min, int max) {
            Minimum = min;
            Maximum = max;
        }
    }

    public int Columns = 8;                                         //Number of columns in our game board.
    public int Rows = 8;                                            //Number of rows in our game board.
    public Count WallCount = new Count(5, 9);                      //Lower and upper limit for our random number of walls per level.
    public Count FoodCount = new Count(1, 5);                      //Lower and upper limit for our random number of food items per level.
    public GameObject Exit;                                         //Prefab to spawn for exit.
    public GameObject[] FloorTiles;                                 //Array of floor prefabs.
    public GameObject[] WallTiles;                                  //Array of wall prefabs.
    public GameObject[] FoodTiles;                                  //Array of food prefabs.
    public GameObject[] EnemyTiles;                                 //Array of enemy prefabs.
    public GameObject[] OuterWallTiles;                             //Array of outer tile prefabs.

    private Transform BoardHolder;                                  //A variable to store a reference to the transform of our Board object.
    private List<Vector3> GridPositions = new List<Vector3>();   //A list of possible locations to place tiles.

    void InitialiseList() {

        GridPositions.Clear();

        for(int i = 0; i < Columns - 1; i++) {
            for(int j = 0; j < Rows - 1; j++) {
                GridPositions.Add(new Vector3(i, j, 0f));
            }
        }

    }

    void BoardSetup() {
        BoardHolder = new GameObject("Board").transform;


    }

    Vector3 RandomPosition() { }

    void LayoutObjectAtRandom(GameObject[] tileArray, int minimum, int maximum) { }

    public void SetupScene(int level) { }


}
