using System;
using System.Collections.Generic;
using System.Text;

namespace Example_Events {

    public class Entity {

        public int X { get; private set; }
        public int Y { get; private set; }
        public int Gravity { get; private set; }
        public bool IsHero { get; private set; }

        public Entity(bool isHero) {
            X = 0;
            Y = 0;
            IsHero = isHero;
        }

        public void Accelerate(int gravity) {
            Gravity = gravity;
        }

        public void Update() {
            Y -= Gravity;
            X += Gravity;
        }

        public bool IsOnSurface() {
            var h = -10;
            return (Y < h ? false : true);
        }
    }

    // Função responsável por notificar os observers
    public delegate void StateChangeHandler(Entity entity, EVENTS_ACHIEVEMENTS evento);

    // SUBJECT
    public static class Physics {

        public const int GRAVITY = 11;

        public static void UpdateEntity(Entity entity) {
            bool wasOnSurface = entity.IsOnSurface();
            entity.Accelerate(GRAVITY);
            entity.Update();

            if(wasOnSurface && !entity.IsOnSurface()) {
                OnChange?.Invoke(entity, EVENTS_ACHIEVEMENTS.EVENT_ENTITY_FELL);
            }
        }

        private static event StateChangeHandler OnChange;
        public static event StateChangeHandler OnStateChange {
            add {
                OnChange += value;
            }
            remove {
                OnChange -= value;
            }
        }

    }
}
