using System;
using System.Collections.Generic;
using System.Linq;

namespace FunctionalBuilderPattern {
    class Person {
        public static PersonBuilder Builder() => new PersonBuilder();

        public string Name;
        public string Position;

        public override string ToString() {
            return $"{Name} is working as {Position}";
        }
    }

    class FunctionalBuilder<TSubject, TSelf>
        where TSubject : new()
        where TSelf : FunctionalBuilder<TSubject, TSelf> {
        private readonly List<Func<TSubject, TSubject>> actions
            = new List<Func<TSubject, TSubject>>();

        public TSelf Do(Action<TSubject> action) => AddAction(action);

        public TSubject Build() => actions.Aggregate(new TSubject(), (p, f) => f(p));

        protected TSelf AddAction(Action<TSubject> action) {
            actions.Add(p => {
                action(p);
                return p;
            });

            return (TSelf)this;
        }
    }

    sealed class PersonBuilder : FunctionalBuilder<Person, PersonBuilder> {
        public PersonBuilder Called(string name) => AddAction(person => person.Name = name);
    }

    static class PersonBuilderExtension {
        public static PersonBuilder WorkAs(this PersonBuilder builder, string position){
            return builder.Do(p => p.Position = position);
        }
    }

    class Program {
        static void Main(string[] args) {
            var person = Person.Builder()
                .Called("Bruno")
                .WorkAs("Programmer")
                .Build();

            Console.WriteLine(person);
        }
    }
}
