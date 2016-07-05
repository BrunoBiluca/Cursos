using UnityEngine;
using System.Collections;
using System.Collections.Generic;
using UnityEngine.UI;

public class LayoutPuzzleButtons : MonoBehaviour {

	[SerializeField]
	private SetupPuzzleGame setupPuzzleGameAux;

	[SerializeField]
	private Transform puzzleGameHolder1, puzzleGameHolder2, puzzleGameHolder3, puzzleGameHolder4, puzzleGameHolder5;

	public List<Button> level1Buttons, level2Buttons, level3Buttons, level4Buttons, level5Buttons;
	public List<Animator> level1Anims, level2Anims, level3Anims, level4Anims, level5Anims;

	[SerializeField]
	private Sprite[] puzzleButtonsBG;

	private int selectedLevel;
	private string selectedPuzzle;

	public void LayoutButtons(int level, string puzzle){
		this.selectedLevel = level;
		this.selectedPuzzle = puzzle;

		setupPuzzleGameAux.SetLevelAndPuzzle (selectedLevel, selectedPuzzle);

		LayoutPuzzle ();
	}

	private void LayoutPuzzle(){
		switch (selectedLevel) {
		case 1:
			foreach (Button btn in level1Buttons) {
				if (!btn.gameObject.activeInHierarchy) {
					btn.gameObject.SetActive (true);
					btn.gameObject.transform.SetParent (puzzleGameHolder1, false);

					if (selectedPuzzle == "Candy Puzzle") {
						btn.image.sprite = puzzleButtonsBG [0];
					} else if (selectedPuzzle == "Transport Puzzle") {
						btn.image.sprite = puzzleButtonsBG [1];
					} else if (selectedPuzzle == "Fruit Puzzle") {
						btn.image.sprite = puzzleButtonsBG [2];
					} 
				}
			}

			setupPuzzleGameAux.SetButtonsAndAnimators (level1Buttons, level1Anims);

			break;
		case 2:
			foreach (Button btn in level2Buttons) {
				if (!btn.gameObject.activeInHierarchy) {
					btn.gameObject.SetActive (true);
					btn.gameObject.transform.SetParent (puzzleGameHolder2, false);

					if (selectedPuzzle == "Candy Puzzle") {
						btn.image.sprite = puzzleButtonsBG [0];
					} else if (selectedPuzzle == "Transport Puzzle") {
						btn.image.sprite = puzzleButtonsBG [1];
					} else if (selectedPuzzle == "Fruit Puzzle") {
						btn.image.sprite = puzzleButtonsBG [2];
					} 
				}
			}

			setupPuzzleGameAux.SetButtonsAndAnimators (level2Buttons, level2Anims);

			break;
		case 3:
			foreach (Button btn in level3Buttons) {
				if (!btn.gameObject.activeInHierarchy) {
					btn.gameObject.SetActive (true);
					btn.gameObject.transform.SetParent (puzzleGameHolder3, false);

					if (selectedPuzzle == "Candy Puzzle") {
						btn.image.sprite = puzzleButtonsBG [0];
					} else if (selectedPuzzle == "Transport Puzzle") {
						btn.image.sprite = puzzleButtonsBG [1];
					} else if (selectedPuzzle == "Fruit Puzzle") {
						btn.image.sprite = puzzleButtonsBG [2];
					} 
				}
			}

			setupPuzzleGameAux.SetButtonsAndAnimators (level3Buttons, level3Anims);

			break;
		case 4:
			foreach (Button btn in level4Buttons) {
				if (!btn.gameObject.activeInHierarchy) {
					btn.gameObject.SetActive (true);
					btn.gameObject.transform.SetParent (puzzleGameHolder4, false);

					if (selectedPuzzle == "Candy Puzzle") {
						btn.image.sprite = puzzleButtonsBG [0];
					} else if (selectedPuzzle == "Transport Puzzle") {
						btn.image.sprite = puzzleButtonsBG [1];
					} else if (selectedPuzzle == "Fruit Puzzle") {
						btn.image.sprite = puzzleButtonsBG [2];
					} 
				}
			}

			setupPuzzleGameAux.SetButtonsAndAnimators (level4Buttons, level4Anims);

			break;
		case 5:
			foreach (Button btn in level5Buttons) {
				if (!btn.gameObject.activeInHierarchy) {
					btn.gameObject.SetActive (true);
					btn.gameObject.transform.SetParent (puzzleGameHolder5, false);

					if (selectedPuzzle == "Candy Puzzle") {
						btn.image.sprite = puzzleButtonsBG [0];
					} else if (selectedPuzzle == "Transport Puzzle") {
						btn.image.sprite = puzzleButtonsBG [1];
					} else if (selectedPuzzle == "Fruit Puzzle") {
						btn.image.sprite = puzzleButtonsBG [2];
					} 
				}
			}

			setupPuzzleGameAux.SetButtonsAndAnimators (level5Buttons, level5Anims);

			break;
		}
	}
}
