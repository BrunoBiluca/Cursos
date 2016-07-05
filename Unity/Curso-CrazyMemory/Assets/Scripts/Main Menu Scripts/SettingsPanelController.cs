using UnityEngine;
using System.Collections;
using UnityEngine.UI;

public class SettingsPanelController : MonoBehaviour {

	[SerializeField]
	private GameObject settingsPanel;

	[SerializeField]
	private MusicController musicControllerAux;

	[SerializeField]
	private Animator settingsAnim;

	[SerializeField]
	private Slider slider;

	public void OpenSettingsPanel(){
		slider.value = musicControllerAux.GetMusicVolume ();
		settingsPanel.SetActive (true);
		settingsAnim.Play ("SlideIn");
	}

	public void CloseSettingsPanel(){
		StartCoroutine (CloseSettings ());
	}

	IEnumerator CloseSettings(){
		settingsAnim.Play ("SlideOut");
		yield return new WaitForSeconds (1f);
		settingsPanel.SetActive (false);
	}

	public void SetVolume(float volume){
		musicControllerAux.SetMusicVolume (volume);
	}

}
