using UnityEngine;
using System.Collections;
using Assets.UnityFoundation.SceneFader;
using Assets.UnityFoundation.CameraScripts;

namespace Assets.Scripts {
    public class MenuController : MonoBehaviour {

        public static MenuController Instance;

        [SerializeField]
        private GameObject[] birds;

        private bool isGreenBirdUnlock, isRedBirdUnlock;

        void Awake() {
            Instance = this;
        }

        void Start() {
            SelectBird();
            CheckIfBirdsAreUnlocked();
        }

        private void SelectBird() {
            birds[GameController.Instance.getSelectedBird()].SetActive(true);
        }

        public void PlayGame() {
            SceneFader.Instance.FadeIn("Gameplay");
        }

        void CheckIfBirdsAreUnlocked() {
            if(GameController.Instance.isGreenBirdUnlocked() == 1) {
                isGreenBirdUnlock = true;
            }
            if(GameController.Instance.isRedBirdUnlocked() == 1) {
                isRedBirdUnlock = true;
            }

        }

        public void ChangeBird() {
            foreach(var bird in birds) {
                bird.SetActive(false);
            }

            if(isGreenBirdUnlock && GameController.Instance.getSelectedBird() == 0) {
                GameController.Instance.setSelectedBird(1);
                SelectBird();
            } else if(isRedBirdUnlock && GameController.Instance.getSelectedBird() == 1) {
                GameController.Instance.setSelectedBird(2);
                SelectBird();
            } else {
                GameController.Instance.setSelectedBird(0);
                SelectBird();
            }
        }

    }
}