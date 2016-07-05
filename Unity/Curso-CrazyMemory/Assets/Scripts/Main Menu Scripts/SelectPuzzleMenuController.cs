using UnityEngine;
using System.Collections;
using UnityEngine.EventSystems;

public class SelectPuzzleMenuController : MonoBehaviour {

	[SerializeField]
	private PuzzleGameManager puzzleGameManagerAux;

	[SerializeField]
	private LevelLocker levelLockerAux;

	[SerializeField]
	private StarsLocker starsLockerAux;

	[SerializeField]
	private LoadPuzzleGame loadPuzzleGameAux;

	[SerializeField]
	private GameObject selectPuzzleMenuPanel, puzzleLevelSelectMenuPanel;

	[SerializeField]
	private Animator selectPuzzleMenuAnim, puzzleLevelSelectMenuAnim;

	private string selectPuzzle;
	private int selectLevel;

	private bool[] puzzles;

	public void SelectedPuzzle(){
		starsLockerAux.DeactivateStars ();

		selectPuzzle = EventSystem.current.currentSelectedGameObject.name;

		puzzleGameManagerAux.SetSelectedPuzzle (selectPuzzle);

		levelLockerAux.CheckWhichLevelsAreUnlock (selectPuzzle);

		StartCoroutine (ShowPuzzleLevelSelectMenu ());
	}

	IEnumerator ShowPuzzleLevelSelectMenu(){
		puzzleLevelSelectMenuPanel.SetActive (true);
		selectPuzzleMenuAnim.Play ("SlideOut");
		puzzleLevelSelectMenuAnim.Play ("SlideIn");
		yield return new WaitForSeconds (1f);
		selectPuzzleMenuPanel.SetActive (false);
	}

	public void SelectedPuzzleLevel(){
		selectLevel = int.Parse (EventSystem.current.currentSelectedGameObject.name);

		puzzleGameManagerAux.SetSelectedLevel (selectLevel);

		puzzles = levelLockerAux.GetPuzzleLevels (selectPuzzle);

		if (puzzles [selectLevel-1]) {
			loadPuzzleGameAux.PuzzleLoad (selectLevel, selectPuzzle);
		}
	}


	public void BackToSelectPuzzleMenu(){
		StartCoroutine (ShowPuzzleSelectMenu ());
	}

	IEnumerator ShowPuzzleSelectMenu(){
		selectPuzzleMenuPanel.SetActive (true);
		puzzleLevelSelectMenuAnim.Play ("SlideOut");
		selectPuzzleMenuAnim.Play ("SlideIn");
		yield return new WaitForSeconds (1f);
		puzzleLevelSelectMenuPanel.SetActive (false);
	}




}
