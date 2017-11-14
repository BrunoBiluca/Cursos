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

        for(int i = 1; i < Columns - 1; i++) {
            for(int j = 1; j < Rows - 1; j++) {
                GridPositions.Add(new Vector3(i, j, 0f));
            }
        }

    }

    void BoardSetup() {
        BoardHolder = new GameObject("Board").transform;

        for(int i = -1; i < Columns + 1; i++) {
            for(int j = -1; j < Rows + 1; j++) {
                GameObject toInstantiate = FloorTiles[Random.Range(0, FloorTiles.Length)];

                if(i == -1 || i == Columns || j == -1 || j == Rows)
                    toInstantiate = OuterWallTiles[Random.Range(0, OuterWallTiles.Length)];

                GameObject instance = Instantiate(toInstantiate, new Vector3(i, j, 0), Quaternion.identity);

                instance.transform.SetParent(BoardHolder);
            }
        }
    }

    Vector3 RandomPosition() {
        int index = Random.Range(0, GridPositions.Count);

        Vector3 position = GridPositions[index];

        GridPositions.RemoveAt(index);

        return position;
    }

    void LayoutObjectAtRandom(GameObject[] tileArray, int minimum, int maximum) {
        int objectCount = Random.Range(minimum, maximum);

        for(int i = 0; i < objectCount - 1; i++) {
            Vector3 randomPosition = RandomPosition();

            GameObject instance = Instantiate(tileArray[Random.Range(0, tileArray.Length)], randomPosition, Quaternion.identity);

            instance.transform.SetParent(BoardHolder);
        }
    }

    public void SetupScene(int level) {
        BoardSetup();

        InitialiseList();

        LayoutObjectAtRandom(WallTiles, WallCount.Minimum, WallCount.Maximum);

        LayoutObjectAtRandom(FoodTiles, FoodCount.Minimum, FoodCount.Maximum);

        int enemyCount = (int)Mathf.Log(level, 2f);

        LayoutObjectAtRandom(EnemyTiles, enemyCount, enemyCount);

        Instantiate(Exit, new Vector3(Columns - 1, Rows - 1, 0), Quaternion.identity);
    }


}
