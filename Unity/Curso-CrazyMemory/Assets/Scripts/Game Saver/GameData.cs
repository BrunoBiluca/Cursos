using UnityEngine;
using System.Collections;
using System;
using System.IO;
using System.Runtime.Serialization.Formatters.Binary;

[Serializable]
public class GameData{

	private bool[] candyPuzzleLevels;
	private bool[] transportPuzzleLevels;
	private bool[] fruitsPuzzleLevels;

	private int[] candyPuzzleLevelStars;
	private int[] transportPuzzleLevelStars;
	private int[] fruitsPuzzleLevelStars;

	private bool isGameStartedFirstTime;

	private float musicVolume;

	public void SetCandyPuzzleLevels(bool[] candyPuzzleLevels){
		this.candyPuzzleLevels = candyPuzzleLevels;
	}

	public bool[] GetCandyPuzzleLevels(){
		return this.candyPuzzleLevels;
	}

	public void SetTransportPuzzleLevels(bool[] transportPuzzleLevels){
		this.transportPuzzleLevels = transportPuzzleLevels;
	}

	public bool[] GetTransportPuzzleLevels(){
		return this.transportPuzzleLevels;
	}

	public void SetFruitsPuzzleLevels(bool[] fruitsPuzzleLevels){
		this.fruitsPuzzleLevels = fruitsPuzzleLevels;
	}

	public bool[] GetFruitsPuzzleLevels(){
		return this.fruitsPuzzleLevels;
	}

	public void SetCandyPuzzleLevelStars(int[] candyPuzzleLevelStars){
		this.candyPuzzleLevelStars = candyPuzzleLevelStars;
	}

	public int[] GetCandyPuzzleLevelStars(){
		return this.candyPuzzleLevelStars;
	}

	public void SetTransportPuzzleLevelStars(int[] transportPuzzleLevelStars){
		this.transportPuzzleLevelStars = transportPuzzleLevelStars;
	}

	public int[] GetTransportPuzzleLevelStars(){
		return this.transportPuzzleLevelStars;
	}

	public void SetFruitsPuzzleLevelStars(int[] fruitsPuzzleLevelStars){
		this.fruitsPuzzleLevelStars = fruitsPuzzleLevelStars;
	}

	public int[] GetFruitsPuzzleLevelStars(){
		return this.fruitsPuzzleLevelStars;
	}

	public void SetIsGameStartedFirstTime(bool isGameStartedFirstTime){
		this.isGameStartedFirstTime = isGameStartedFirstTime;
	}

	public bool GetIsGameStartedFirstTime(){
		return this.isGameStartedFirstTime;
	}

	public void SetMusicVolume(float musicVolume){
		this.musicVolume = musicVolume;
	}

	public float GetMusicVolume(){
		return this.musicVolume;
	}



}
