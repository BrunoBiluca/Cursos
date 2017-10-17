using System;
using System.Collections.Generic;
using System.Text;

namespace Example_Events {

    public enum EVENTS_ACHIEVEMENTS {
        EVENT_ENTITY_FELL,
        EVENT_ENTITY_WALK
    }

    public enum ACHIEVEMENTS {
        FELL_OFF_BRIDGE,
        WALKER
    }

    public static class Achievements {

        public static void OnNotify(Entity entity, EVENTS_ACHIEVEMENTS evento) {
            switch (evento) {
                case EVENTS_ACHIEVEMENTS.EVENT_ENTITY_FELL:
                    if (entity.IsHero)
                        Unlock(ACHIEVEMENTS.FELL_OFF_BRIDGE);
                    break;
                case EVENTS_ACHIEVEMENTS.EVENT_ENTITY_WALK:
                    if (entity.IsHero && entity.X > 100)
                        Unlock(ACHIEVEMENTS.WALKER);
                    break;
                default:
                    break;
            }
        }

        private static void Unlock(ACHIEVEMENTS achievement) {
            switch (achievement) {
                case ACHIEVEMENTS.FELL_OFF_BRIDGE:
                    Console.WriteLine("Você pulou da ponte! Parabáins!");
                    break;
                case ACHIEVEMENTS.WALKER:
                    Console.WriteLine("Andou ba garai fi! Parabáins!");
                    break;
                default:
                    break;
            }
        }
    }
}
