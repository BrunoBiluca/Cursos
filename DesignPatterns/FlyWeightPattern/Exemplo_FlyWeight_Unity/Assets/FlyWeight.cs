using System;
using System.Collections.Generic;
using UnityEngine;

namespace Assets {
    class FlyWeight : MonoBehaviour {

        List<Alien> AllAliens = new List<Alien>();

        /// <summary>
        /// Objetos que serão compartilhados
        /// </summary>
        List<Vector3> EyePositions; 
        List<Vector3> LegPositions;
        List<Vector3> ArmPositions;

        /// <summary>
        /// Devemos reparar no uso total de memória que cai de 0.69Gb para 176Mb
        /// Principalmente a informação do "Mono" que é o tamanho total do heap que é utilizado
        /// </summary>
        void Start() {
            EyePositions = GetBodyPartPositions();
            LegPositions = GetBodyPartPositions();
            ArmPositions = GetBodyPartPositions();
            
            //Create all aliens
            for (int i = 0; i < 10000; i++) {
                Alien newAlien = new Alien();

                //Without flyweight
                //newAlien.EyePositions = GetBodyPartPositions();
                //newAlien.ArmPositions = GetBodyPartPositions();
                //newAlien.LegPositions = GetBodyPartPositions();

                //With flyweight
                newAlien.EyePositions = EyePositions;
                newAlien.ArmPositions = LegPositions;
                newAlien.LegPositions = ArmPositions;

                AllAliens.Add(newAlien);
            }
        }

        private List<Vector3> GetBodyPartPositions() {
            List<Vector3> bodyPartPositions = new List<Vector3>();

            // Simula um objeto com 1000 pontos
            for (int i = 0; i < 1000; i++) {
                bodyPartPositions.Add(new Vector3());
            }

            return bodyPartPositions;
        }
    }
}
