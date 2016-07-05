using UnityEngine;
using System.Collections;

public class LevelLocker : MonoBehaviour {

	[SerializeField]
	private GameSaver gameSaverAux;

	[SerializeField]
	private StarsLocker starsLockerAux;

	[SerializeField]
	private GameObject[] levelStarsHolders;

	[SerializeField]
	private GameObject[] levelPadLocks;

	private bool[] candyPuzzleLevels;
	private bool[] transportPuzzleLevels;
	private bool[] fruitsPuzzleLevels;

	void Awake(){
		DeactivatePadLockAndHolders ();
	}

	void Start(){
		GetLevels ();
	}

	public void CheckWhichLevelsAreUnlock(string selectedPuzzle){

		DeactivatePadLockAndHolders ();
		GetLevels ();

		switch (selectedPuzzle) {
		case "Candy Puzzle":
			for (int i = 0; i < candyPuzzleLevels.Length; i++) {
				if (candyPuzzleLevels [i]) {
					levelStarsHolders [i].SetActive (true);
					starsLockerAux.ActivateStars (i, selectedPuzzle);
				} else {
					levelPadLocks [i].SetActive (true);
				}
			}

			break;
		case "Transport Puzzle":
			for (int i = 0; i < transportPuzzleLevels.Length; i++) {
				if (transportPuzzleLevels [i]) {
					levelStarsHolders [i].SetActive (true);
					starsLockerAux.ActivateStars (i, selectedPuzzle);
				} else {
					levelPadLocks [i].SetActive (true);
				}
			}

			break;
		case "Fruit Puzzle":
			for (int i = 0; i < fruitsPuzzleLevels.Length; i++) {
				if (fruitsPuzzleLevels [i]) {
					levelStarsHolders [i].SetActive (true);
					starsLockerAux.ActivateStars (i, selectedPuzzle);
				} else {
					levelPadLocks [i].SetActive (true);
				}
			}

			break;
		}


	}

	private void DeactivatePadLockAndHolders(){

		for (int i = 0; i < levelStarsHolders.Length; i++) {
			levelStarsHolders [i].SetActive (false);
			levelPadLocks [i].SetActive (false);
		}
			
	}

	private void GetLevels(){
		candyPuzzleLevels = gameSaverAux.candyPuzzleLevels;
		transportPuzzleLevels = gameSaverAux.transportPuzzleLevels;
		fruitsPuzzleLevels = gameSaverAux.fruitsPuzzleLevels;
	}

	public bool[] GetPuzzleLevels(string selectedPuzzle){
	
		switch (selectedPuzzle) {
		case "Candy Puzzle":
			return this.candyPuzzleLevels;
			break;
		case "Transport Puzzle":
			return this.transportPuzzleLevels;
			break;
		case "Fruit Puzzle":
			return this.fruitsPuzzleLevels;
			break;
		default:
			return null;
			break;
		}


	}


}
