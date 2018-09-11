using System;
using System.Collections.Generic;

namespace Coding.Exercise {

    public abstract class CreatureModifier : IDisposable {

        protected Game Game;
        protected Creature Creature;

        protected CreatureModifier(Game game, Creature creature){
            Game = game;
            Creature = creature;
            Game.Queries += Handle;
        }

        protected abstract void Handle(object sender, Query query);

        public void Dispose() {
            Game.Queries -= Handle;
        }
    }

    public class GoblinKingAttackBuff : CreatureModifier {
        public GoblinKingAttackBuff(Game game, Creature creature) : base(game, creature) {
        }

        protected override void Handle(object sender, Query query) {
            foreach(var creature in Game.Creatures){
                if(creature.GetType() == typeof(GoblinKing)){
                    query.Value += 1;
                }
            }
        }
    }

    public class GoblinDefenseBuff : CreatureModifier
    {
        public GoblinDefenseBuff(Game game, Creature creature) : base(game, creature) {
        }

        protected override void Handle(object sender, Query query) {
            query.Value += Game.Creatures.Count - 1;
        }
    }

    public abstract class Creature {
        protected Game game;
      protected readonly int initialAttack;
      protected readonly int initialDefense;

      public abstract int Attack {get;}
      public abstract int Defense {get;}

        public Creature(Game game, int initialAttack, int initialDefense) { 
            this.game = game;
            this.initialAttack = initialAttack;
            this.initialDefense = initialDefense;
        }

    }

    public class Goblin : Creature {
        private int v1;
        private int v2;

        public Goblin(Game game) : base(game, 1, 1) {
        }

        public Goblin(Game game, int initialAttack, int initialDefense) : base(game, initialAttack, initialDefense)
        {
        }

        public override int Attack { 
            get {
                using(var buff = new GoblinKingAttackBuff(game, this)){
                    var query =  new Query(buff, initialAttack);
                    game.PerformQuery(this, query);
                    return query.Value; 
                }
            }
        }
        public override int Defense { 
            get {
                using (var buff = new GoblinDefenseBuff(game, this)){
                    var query = new Query(buff, initialDefense);
                    game.PerformQuery(this, query);
                    return query.Value;
                }
            } 
        }

        public override string ToString(){
            return $"Goblin: Attack {Attack} - Defense {Defense}";
        }
    }

    public class GoblinKing : Goblin {
        public GoblinKing(Game game) : base(game, 3, 3)
        {
        }

        public GoblinKing(Game game, int initialAttack, int initialDefense) : base(game, initialAttack, initialDefense)
        {
        }

        public override string ToString(){
            return $"GoblinKing: Attack {Attack} - Defense {Defense}";
        }
    }

    public class Game {
      public IList<Creature> Creatures;
      public event EventHandler<Query> Queries;

        public Game() {
            Creatures = new List<Creature>();
        }

        public void PerformQuery(object sender, Query q) {
            Queries?.Invoke(sender, q);
        }
    }

    public class Query {
        public CreatureModifier Modifier;

        public int Value;

        public Query(CreatureModifier modifier, int value){
            Modifier = modifier;
            Value = value;
        }
    }

    public class Program{
        static void Main(){
            var game = new Game();
            game.Creatures.Add(new Goblin(game, 1, 1));
            game.Creatures.Add(new Goblin(game, 1, 1));
            game.Creatures.Add(new Goblin(game, 1, 1));
            game.Creatures.Add(new Goblin(game, 1, 1));
            game.Creatures.Add(new GoblinKing(game, 1, 1));

            Console.WriteLine(game.Creatures[0].ToString());
            Console.WriteLine(game.Creatures[1].ToString());
            Console.WriteLine(game.Creatures[2].ToString());
            Console.WriteLine(game.Creatures[3].ToString());
            Console.WriteLine(game.Creatures[4].ToString());
        }
    }
  }

