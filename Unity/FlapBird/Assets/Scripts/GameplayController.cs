using UnityEngine;
using System.Collections;
using UnityEngine.UI;
using Assets.UnityFoundation.SceneFader;
using Assets.UnityFoundation.CameraScripts;

namespace Assets.Scripts {
    public class GameplayController : MonoBehaviour {

        public static GameplayController instance;

        [SerializeField]
        private Text scoreText, endScore, bestScore, gameOverText;

        [SerializeField]
        private Button restartGameButton, instructionButton;

        [SerializeField]
        private GameObject pausePanel;

        [SerializeField]
        private GameObject[] birds;

        [SerializeField]
        private Sprite[] medals;

        [SerializeField]
        private Image medalImage;

        void Awake() {
            MakeInstance();
        }

        void MakeInstance() {
            if(instance == null)
                instance = this;

            Time.timeScale = 0f;
        }

        public void PauseGame() {
            if(BirdScript.instance != null) {
                if(BirdScript.instance.isAlive) {
                    pausePanel.SetActive(true);
                    gameOverText.gameObject.SetActive(false);
                    endScore.text = "" + BirdScript.instance.score;
                    bestScore.text = "" + GameController.Instance.getHighScore();
                    Time.timeScale = 0f;
                    restartGameButton.onClick.RemoveAllListeners();
                    restartGameButton.onClick.AddListener(() => ResumeGame());
                }
            }
        }

        public void GoToMenuButton() {
            SceneFader.Instance.FadeIn("MainMenu");
        }

        public void ResumeGame() {
            pausePanel.SetActive(false);
            Time.timeScale = 1.0f;
        }

        public void RestartGame() {
            SceneFader.Instance.FadeIn(Application.loadedLevelName);
        }

        public void PlayGame() {

            scoreText.gameObject.SetActive(true);

            var bird = birds[GameController.Instance.getSelectedBird()];
            bird.SetActive(true);

            CameraFollower.Instance.Setup(bird.GetComponent<BirdScript>());

            instructionButton.gameObject.SetActive(false);
            Time.timeScale = 1.0f;
        }

        public void SetScore(int score) {
            scoreText.text = "" + score;
        }

        public void PlayerDiedShowScore(int score) {
            pausePanel.SetActive(true);
            gameOverText.gameObject.SetActive(true);
            scoreText.gameObject.SetActive(false);

            endScore.text = "" + score;

            if(score > GameController.Instance.getHighScore()) {
                GameController.Instance.setHighScore(score);
            }

            bestScore.text = "" + GameController.Instance.getHighScore();

            if(score <= 20) {
                medalImage.sprite = medals[0];
            } else if(score > 20 && score <= 40) {
                medalImage.sprite = medals[1];

                if(GameController.Instance.isGreenBirdUnlocked() == 0) {
                    GameController.Instance.unlockGreenBird();
                }
            } else if(score > 40) {
                medalImage.sprite = medals[2];

                if(GameController.Instance.isGreenBirdUnlocked() == 0) {
                    GameController.Instance.unlockGreenBird();
                }
                if(GameController.Instance.isRedBirdUnlocked() == 0) {
                    GameController.Instance.unlockRedBird();
                }
            }

            restartGameButton.onClick.RemoveAllListeners();
            restartGameButton.onClick.AddListener(() => RestartGame());
        }

    }
}