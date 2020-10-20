using Microsoft.VisualStudio.TestTools.UnitTesting;
using System;
using System.IO;

namespace Challenges.Tests {
    [TestClass()]
    public class ArraysChallengeTests {
        [TestMethod()]
        public void MainTest() {
            using var inWritter = new StreamWriter("./input_07_arrays.txt");
            inWritter.WriteLine("4");
            inWritter.WriteLine("2 3 1 4");
            inWritter.Close();

            using var outWritter = new StreamWriter("./output_07_arrays.txt");
            outWritter.WriteLine("4 1 3 2");
            outWritter.Close();

            using var streamReader = new StreamReader("./input_07_arrays.txt");
            Console.SetIn(streamReader);

            using var myOutputStream = new StreamWriter("./out.txt");
            Console.SetOut(myOutputStream);

            ArraysChallenge.Main();

            myOutputStream.Close();
            using var myOutput = new StreamReader("./out.txt");

            using var expectedOutput = new StreamReader("./output_07_arrays.txt");
            Assert.AreEqual(expectedOutput.ReadToEnd(), myOutput.ReadToEnd());
        }
    }
}