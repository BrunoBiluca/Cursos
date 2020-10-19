using System;
using System.Diagnostics;
using System.IO;
using Microsoft.VisualStudio.TestTools.UnitTesting;

namespace Challenges.Tests {
    [TestClass]
    public class LoopsChallengeTests {

        [TestMethod]
        public void TestInput1() {
            // Custom output
            var outputFile = "./out.txt";
            using var streamWritter = new StreamWriter(outputFile);
            Console.SetOut(streamWritter);

            // Test action
            using var stream = new StreamReader("./resources/input/input00.txt");
            var n = int.Parse(stream.ReadToEnd());
                     
            LoopsChallenge.WriteFirst10Multipliers(n);

            // Capture my custom outuput 
            streamWritter.Close();            
            using var myOutput = new StreamReader(outputFile);

            // Test assertion
            using var resultFile = new StreamReader("./resources/output/output00.txt");
            var resultOutput = resultFile.ReadToEnd();

            Assert.AreEqual(resultOutput, myOutput.ReadToEnd());
        }
    }
}
