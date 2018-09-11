using System;
using System.Collections.Generic;

  namespace Coding.Exercise
  {
    public class Participant
    {
      public int Value { get; set; }
      private Mediator mediator;

      public Participant(Mediator mediator)
      {
        this.mediator = mediator;
        this.mediator.participants.Add(this);
      }

      public void Say(int n)
      {
        mediator.Broadcast(n, this);
      }
    }

    public class Mediator
    {
        public List<Participant> participants = new List<Participant>();
        
        public void Broadcast(int n, Participant sender){
            
            foreach(var participant in participants){
                if(Object.ReferenceEquals(participant, sender)) continue;
                participant.Value = n;    
            }
        }
    }
  }
