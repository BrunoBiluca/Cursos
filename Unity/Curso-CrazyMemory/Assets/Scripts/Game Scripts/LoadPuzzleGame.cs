using UnityEngine;
using System.Collections;
using System.Collections.Generic;

public class LoadPuzzleGame : MonoBehaviour {

	[SerializeField]
	private PuzzleGameManager puzzleGameManagerAux;

	[SerializeField]
	private LevelLocker levelLockerAux;

	[SerializeField]
	private LayoutPuzzleButtons layoutPuzzleButtonsAux;

	[SerializeField]
	private GameObject puzzleLevelSelectMenuPanel;

	[SerializeField]
	private Animator puzzleLevelSelectMenuAnim;

	[SerializeField]
	private GameObject puzzleGamePanel1, puzzleGamePanel2, puzzleGamePanel3, puzzleGamePanel4, puzzleGamePanel5;

	[SerializeField]
	private Animator puzzleGameAnim1, puzzleGameAnim2, puzzleGameAnim3, puzzleGameAnim4, puzzleGameAnim5;

	private string selectedPuzzle;
	private int selectedLevel;

	List<Animator> anims = new List<Animator> ();

	public void PuzzleLoad(int level, string puzzle){
		this.selectedPuzzle = puzzle;
		this.selectedLevel = level;

		layoutPuzzleButtonsAux.LayoutButtons (selectedLevel, selectedPuzzle);

		switch(selectedLevel){
		case 1:
			StartCoroutine (ShowLoadPuzzle (puzzleGamePanel1, puzzleGameAnim1));
			break;
		case 2:
			StartCoroutine (ShowLoadPuzzle (puzzleGamePanel2, puzzleGameAnim2));
			break;
		case 3:
			StartCoroutine (ShowLoadPuzzle (puzzleGamePanel3, puzzleGameAnim3));
			break;
		case 4:
			StartCoroutine (ShowLoadPuzzle (puzzleGamePanel4, puzzleGameAnim4));
			break;
		case 5:
			StartCoroutine (ShowLoadPuzzle (puzzleGamePanel5, puzzleGameAnim5));
			break;
		}
	}

	public void BackToPuzzleLevelSelectMenu(){

		anims = puzzleGameManagerAux.ResetGameplay ();

		levelLockerAux.CheckWhichLevelsAreUnlock (selectedPuzzle);

		switch(selectedLevel){
		case 1:
			StartCoroutine (ShowPuzzleLevelSelectMenu (puzzleGamePanel1, puzzleGameAnim1));
			break;
		case 2:
			StartCoroutine (ShowPuzzleLevelSelectMenu (puzzleGamePanel2, puzzleGameAnim2));
			break;
		case 3:
			StartCoroutine (ShowPuzzleLevelSelectMenu (puzzleGamePanel3, puzzleGameAnim3));
			break;
		case 4:
			StartCoroutine (ShowPuzzleLevelSelectMenu (puzzleGamePanel4, puzzleGameAnim4));
			break;
		case 5:
			StartCoroutine (ShowPuzzleLevelSelectMenu (puzzleGamePanel5, puzzleGameAnim5));
			break;
		}
	}

	IEnumerator ShowLoadPuzzle(GameObject puzzleGamePanel, Animator puzzleGameAnim){
		puzzleGamePanel.SetActive (true);
		puzzleGameAnim.Play ("SlideIn");
		puzzleLevelSelectMenuAnim.Play ("SlideOut");
		yield return new WaitForSeconds (1f);
		puzzleLevelSelectMenuPanel.SetActive (false);
	}

	IEnumerator ShowPuzzleLevelSelectMenu(GameObject puzzleGamePanel, Animator puzzleGameAnim){
		puzzleLevelSelectMenuPanel.SetActive (true);
		puzzleLevelSelectMenuAnim.Play ("SlideIn");
		puzzleGameAnim.Play ("SlideOut");

		yield return new WaitForSeconds (1f);

		foreach (Animator anim in anims) {
			anim.Play ("Idle");
		}

		yield return new WaitForSeconds (.5f);

		puzzleGamePanel.SetActive (false);
	}


}
