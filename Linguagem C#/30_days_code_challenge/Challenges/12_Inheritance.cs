using System;
using System.Linq;

class Person{
	protected string firstName;
	protected string lastName;
	protected int id;
	
	public Person(){}
	public Person(string firstName, string lastName, int identification){
			this.firstName = firstName;
			this.lastName = lastName;
			this.id = identification;
	}
	public void printPerson(){
		Console.WriteLine("Name: " + lastName + ", " + firstName + "\nID: " + id); 
	}
}

class Student : Person{
    private int[] testScores;  
    
    public Student(string firstName, string lastName, int identification, int[] scores) : base(firstName, lastName, identification){
        testScores = scores;
    }
    
    public string Calculate(){       
        var scoreAverage = CalculateScore();
        return Grade(scoreAverage);
    }
    
    public int CalculateScore(){
        return testScores.Sum() / testScores.Count();
    }
    
    public string Grade(int score){
        if(score >= 90 && score <= 100)
            return "O";
        if(score >= 80 && score < 90)
            return "E";
        if(score >= 70 && score < 80)
            return "A";
        if(score >= 55 && score < 70)
            return "P";
        if(score >= 40 && score < 55)
            return "D";
        if(score < 40)
            return "T";
            
        throw new ArgumentException("Score is invalid");
    }
}

class Solution {
	static void Main() {
		string[] inputs = Console.ReadLine().Split();
		string firstName = inputs[0];
	  	string lastName = inputs[1];
		int id = Convert.ToInt32(inputs[2]);
		int numScores = Convert.ToInt32(Console.ReadLine());
		inputs = Console.ReadLine().Split();
	  	int[] scores = new int[numScores];
		for(int i = 0; i < numScores; i++){
			scores[i]= Convert.ToInt32(inputs[i]);
		} 
	  	
		Student s = new Student(firstName, lastName, id, scores);
		s.printPerson();
		Console.WriteLine("Grade: " + s.Calculate() + "\n");
	}
}
