using UnityEngine;
using System.Collections;

public class GameFineshed : MonoBehaviour {

	[SerializeField]
	private GameObject gameFineshedPanel;

	[SerializeField]
	private Animator gameFineshedPanelAnim, star1Anim, star2Anim, star3Anim, fineshedTextAnim;

	public void ShowGameFineshedPanel(int stars){
		StartCoroutine (ShowPanel (stars));
	}

	public void HideGameFineshedPanel(){
		StartCoroutine (HidePanel ());
	}

	IEnumerator ShowPanel(int stars){

		gameFineshedPanel.SetActive (true);

		gameFineshedPanelAnim.Play ("FadeIn");

		yield return new WaitForSeconds (1.7f);

		if (stars == 1 || stars == 2 || stars == 3) {
			star1Anim.Play ("FadeIn");
		}

		if (stars == 2 || stars == 3) {
			yield return new WaitForSeconds (.25f);
			star2Anim.Play ("FadeIn");
		}

		if (stars == 3) {
			yield return new WaitForSeconds (.25f);
			star3Anim.Play ("FadeIn");
		}

		yield return new WaitForSeconds (.1f);

		fineshedTextAnim.Play ("FadeIn");

	}

	IEnumerator HidePanel(){

		gameFineshedPanelAnim.Play ("FadeOut");

		star1Anim.Play ("FadeOut");
		star2Anim.Play ("FadeOut");
		star3Anim.Play ("FadeOut");

		fineshedTextAnim.Play ("FadeOut");

		yield return new WaitForSeconds (1.5f);

		gameFineshedPanel.SetActive (false);

	}

}
