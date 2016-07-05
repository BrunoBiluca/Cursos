using UnityEngine;
using System.Collections;
using System.Collections.Generic;
using UnityEngine.UI;

public class SetupPuzzleGame : MonoBehaviour {

	[SerializeField]
	private PuzzleGameManager puzzleGameManagerAux;

	private Sprite[] candySprites, transportSprites, fruitSprites;

	[SerializeField]
	private List<Sprite> gamePuzzleSprites = new List<Sprite> ();

	private List<Button> puzzleButtons = new List<Button>();

	private List<Animator> puzzleButtonsAnimators = new List<Animator> ();

	int selectedLevel;
	string selectedPuzzle;

	int looper;

	void Awake(){
		candySprites = Resources.LoadAll<Sprite> ("Sprites/Game Assets/Candy");
		transportSprites = Resources.LoadAll<Sprite> ("Sprites/Game Assets/Transport");
		fruitSprites = Resources.LoadAll<Sprite> ("Sprites/Game Assets/Fruits");
	}

	void PrepareGameSprites(){
		gamePuzzleSprites.Clear ();
		gamePuzzleSprites = new List<Sprite> ();

		switch (selectedLevel) {
		case 1:
			looper = 6;
			break;
		case 2:
			looper = 12;
			break;
		case 3:
			looper = 18;
			break;
		case 4:
			looper = 24;
			break;
		case 5:
			looper = 30;
			break;
		}

		switch (selectedPuzzle) {
		case "Candy Puzzle":
			for (int i = 0; i < (looper / 2); i++) {
				gamePuzzleSprites.Add (candySprites [i]);
				gamePuzzleSprites.Add (candySprites [i]);
			}
			break;
		case "Trasport Puzzle":
			for (int i = 0; i < (looper / 2); i++) {
				gamePuzzleSprites.Add (transportSprites [i]);
				gamePuzzleSprites.Add (transportSprites [i]);
			}
			break;
		case "Fruit Puzzle":
			for (int i = 0; i < (looper / 2); i++) {
				gamePuzzleSprites.Add (fruitSprites [i]);
				gamePuzzleSprites.Add (fruitSprites [i]);
			}
			break;

		}

		Shuffle (gamePuzzleSprites);
	}

	void Shuffle(List<Sprite> list){
		for(int i = 0; i<list.Count; i++){
			Sprite temp = list [i];
			int randomIndex = Random.Range (i, list.Count);
			list [i] = list [randomIndex];
			list [randomIndex] = temp;
		}
	}

	public void SetLevelAndPuzzle(int level, string puzzle){
		this.selectedLevel = level;
		this.selectedPuzzle = puzzle;

		PrepareGameSprites ();

		puzzleGameManagerAux.SetupPuzzleGameSprites (gamePuzzleSprites);
	}

	public void SetButtonsAndAnimators(List<Button> buttons, List<Animator> animators){
		this.puzzleButtons = buttons;
		this.puzzleButtonsAnimators = animators;

		puzzleGameManagerAux.SetupButtonsAndAnimators (puzzleButtons, puzzleButtonsAnimators);
	}

}
