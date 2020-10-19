using Microsoft.VisualStudio.TestTools.UnitTesting;
using Challenges;
using System;
using System.Collections.Generic;
using System.Text;
using System.IO;
using System.Diagnostics;

namespace Challenges.Tests {
    [TestClass()]
    public class LetsReviewChallengeTests {
        [TestMethod()]
        public void PrintEvenOddIndexedCharactersTest() {
            // Custom output
            var outputFile = "./out.txt";
            using var streamWritter = new StreamWriter(outputFile);
            Console.SetOut(streamWritter);

            using var streamReader = new StreamReader("./resources/06_lets_review/input/input00.txt");
            Console.SetIn(streamReader);

            LetsReviewChallenge.PrintEvenOddIndexedCharacters();

            streamWritter.Close();            
            using var myOutputStream = new StreamReader(outputFile);
            var myOutput = myOutputStream.ReadToEnd();

            using var resultFile = new StreamReader("./resources/06_lets_review/output/output00.txt");
            var resultOutput = resultFile.ReadToEnd();

            Assert.AreEqual(resultOutput, myOutput);
        }
    }
}