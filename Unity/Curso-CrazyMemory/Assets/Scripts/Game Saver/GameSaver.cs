using UnityEngine;
using System.Collections;
using System;
using System.IO;
using System.Runtime.Serialization.Formatters.Binary;

public class GameSaver : MonoBehaviour {

	private GameData gameData;

	public bool[] candyPuzzleLevels;
	public bool[] transportPuzzleLevels;
	public bool[] fruitsPuzzleLevels;

	public int[] candyPuzzleLevelStars;
	public int[] transportPuzzleLevelStars;
	public int[] fruitsPuzzleLevelStars;

	private bool isGameStartedFirstTime;

	public float musicVolume;

	void Awake(){
		InitializeGame ();
	}

	void InitializeGame(){
		
		LoadGameData ();

		if (gameData != null) {
			isGameStartedFirstTime = gameData.GetIsGameStartedFirstTime ();
		} else {
			isGameStartedFirstTime = true;
		}

		if (isGameStartedFirstTime) {
			isGameStartedFirstTime = false;

			candyPuzzleLevels = new bool[5];
			transportPuzzleLevels = new bool[5];
			fruitsPuzzleLevels = new bool[5];

			candyPuzzleLevels [0] = true;
			transportPuzzleLevels [0] = true;
			fruitsPuzzleLevels [0] = true;

			for (int i = 1; i < candyPuzzleLevels.Length; i++) {
				candyPuzzleLevels [i] = false;
				transportPuzzleLevels [i] = false;
				fruitsPuzzleLevels [i] = false;
			}

			candyPuzzleLevelStars = new int[5];
			transportPuzzleLevelStars = new int[5];
			fruitsPuzzleLevelStars = new int[5];

			for (int i = 0; i < candyPuzzleLevelStars.Length; i++) {
				candyPuzzleLevelStars [i] = 0;
				transportPuzzleLevelStars [i] = 0;
				fruitsPuzzleLevelStars [i] = 0;
			}

			musicVolume = 0;

			gameData = new GameData ();

			gameData.SetCandyPuzzleLevels(candyPuzzleLevels);
			gameData.SetTransportPuzzleLevels(transportPuzzleLevels);
			gameData.SetFruitsPuzzleLevels(fruitsPuzzleLevels);

			gameData.SetCandyPuzzleLevelStars(candyPuzzleLevelStars);
			gameData.SetTransportPuzzleLevelStars(transportPuzzleLevelStars);
			gameData.SetFruitsPuzzleLevelStars(fruitsPuzzleLevelStars);

			gameData.SetIsGameStartedFirstTime(isGameStartedFirstTime);
			gameData.SetMusicVolume(musicVolume);

			SaveGameData ();
			LoadGameData ();
		
		}

	}

	public void SaveGameData(){
		FileStream file = null;

		try{

			BinaryFormatter bf = new BinaryFormatter();

			file = File.Create(Application.persistentDataPath + "/GameData.dat");

			if(gameData != null){

				gameData.SetCandyPuzzleLevels(candyPuzzleLevels);
				gameData.SetTransportPuzzleLevels(transportPuzzleLevels);
				gameData.SetFruitsPuzzleLevels(fruitsPuzzleLevels);

				gameData.SetCandyPuzzleLevelStars(candyPuzzleLevelStars);
				gameData.SetTransportPuzzleLevelStars(transportPuzzleLevelStars);
				gameData.SetFruitsPuzzleLevelStars(fruitsPuzzleLevelStars);

				gameData.SetIsGameStartedFirstTime(isGameStartedFirstTime);
				gameData.SetMusicVolume(musicVolume);

				bf.Serialize(file, gameData);

			}
				
		}catch(Exception e){
		
		}finally{
			if (file != null) {
				file.Close ();
			}
		}

	}

	void LoadGameData(){
		FileStream file = null;

		try{
			
			BinaryFormatter bf = new BinaryFormatter();

			file = File.Open(Application.persistentDataPath + "/GameData.dat", FileMode.Open);

			gameData = (GameData)bf.Deserialize(file);

			if(gameData != null){
				candyPuzzleLevels = gameData.GetCandyPuzzleLevels();
				transportPuzzleLevels = gameData.GetTransportPuzzleLevels();
				fruitsPuzzleLevels = gameData.GetFruitsPuzzleLevels();

				candyPuzzleLevelStars = gameData.GetCandyPuzzleLevelStars();
				transportPuzzleLevelStars = gameData.GetTransportPuzzleLevelStars();
				fruitsPuzzleLevelStars = gameData.GetFruitsPuzzleLevelStars();

				isGameStartedFirstTime = gameData.GetIsGameStartedFirstTime();
				musicVolume = gameData.GetMusicVolume();

			}

		}catch(Exception e){

		}finally{
			if (file != null) {
				file.Close ();
			}
		}
	}

	public void Save(int selectedLevel, string selectedPuzzle, int stars){
	
		int unlockNextLevel = -1;

		switch (selectedPuzzle) {
		case "Candy Puzzle":

			unlockNextLevel = selectedLevel;

			candyPuzzleLevelStars [selectedLevel - 1] = stars; //Como os níveis estão nomeados começando de 1 é necessário corrigir com -1

			if (unlockNextLevel < candyPuzzleLevels.Length) {
				candyPuzzleLevels [unlockNextLevel] = true;
			}

			break;

		case "Transport Puzzle":

			unlockNextLevel = selectedLevel;

			transportPuzzleLevelStars [selectedLevel - 1] = stars; //Como os níveis estão nomeados começando de 1 é necessário corrigir com -1

			if (unlockNextLevel < transportPuzzleLevels.Length) {
				transportPuzzleLevels [unlockNextLevel] = true;
			}

			break;

		case "Fruit Puzzle":

			unlockNextLevel = selectedLevel;

			fruitsPuzzleLevelStars [selectedLevel - 1] = stars; //Como os níveis estão nomeados começando de 1 é necessário corrigir com -1

			if (unlockNextLevel < fruitsPuzzleLevels.Length) {
				fruitsPuzzleLevels [unlockNextLevel] = true;
			}

			break;


		}

	}


}
