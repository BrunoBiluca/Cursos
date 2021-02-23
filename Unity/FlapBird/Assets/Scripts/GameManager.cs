using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

namespace Assets.Scripts {
    public class GameManager : MonoBehaviour {

        [SerializeField]
        private bool debugMode;

        [SerializeField]
        private bool unlockAllRewards;

        [SerializeField]
        private bool blockAllRewards;

        void Start() {
            UnlockRewards();
            BlockRewards();
        }

        private void UnlockRewards() {
            if(!unlockAllRewards) return;

            GameController.Instance.UnlockAllRewards();
        }

        private void BlockRewards() {
            if(!blockAllRewards) return;

            PlayerPrefs.DeleteKey("isTheGameStartedForTheFirstTime");
            GameController.Instance.IsTheGameStartedForTheFirstTime();
        }
    }
}