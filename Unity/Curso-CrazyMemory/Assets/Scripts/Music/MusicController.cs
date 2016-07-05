using UnityEngine;
using System.Collections;

public class MusicController : MonoBehaviour {

	[SerializeField]
	private GameSaver gameSaverAux;

	private AudioSource bgMusicClip;

	private float musicVolume;

	void Awake(){
		GetAudioSource ();
	}

	void Start(){
		musicVolume = gameSaverAux.musicVolume;
		PlayOrTurnOffMusic (musicVolume);
	}

	void GetAudioSource(){
		bgMusicClip = GetComponent<AudioSource> ();
	}

	public float GetMusicVolume(){
		return this.musicVolume;
	}

	public void SetMusicVolume(float volume){
		PlayOrTurnOffMusic (volume);
	}

	void PlayOrTurnOffMusic(float volume){
		musicVolume = volume;
		bgMusicClip.volume = musicVolume;

		if (bgMusicClip.volume > 0) {
			if (!bgMusicClip.isPlaying) {
				bgMusicClip.Play ();
			}

			gameSaverAux.musicVolume = musicVolume;
			gameSaverAux.SaveGameData ();
		} else if(musicVolume == 0) {
			if (bgMusicClip.isPlaying) {
				bgMusicClip.Stop ();
			}

			gameSaverAux.musicVolume = musicVolume;
			gameSaverAux.SaveGameData ();
		
		}
	}


}
