using Microsoft.VisualStudio.TestTools.UnitTesting;

namespace FlashStack.Tests {
    [TestClass]
    public class FlashStackTests {
        [TestMethod]
        public void PushAndPopOneItemTest() {
            var stack = new FlashStack();
            stack.Push(3);
            var value = stack.Pop();

            Assert.AreEqual(3, value);
        }
        [TestMethod]
        public void PushTwoAndPopOneItemTest() {
            var stack = new FlashStack();
            stack.Push(3);
            stack.Push(5);
            var value = stack.Pop();

            Assert.AreEqual(5, value);
        }
        [TestMethod]
        public void MinimumValueFirstInsertedItemTest() {
            var stack = new FlashStack();
            stack.Push(3);
            stack.Push(5);
            stack.Push(12);

            var minValue = stack.Min();

            Assert.AreEqual(3, minValue);
        }

        [TestMethod]
        public void MinimumValueChangedThreeTimesTest() {
            var stack = new FlashStack();
            stack.Push(5);
            Assert.AreEqual(5, stack.Min());
            stack.Push(3);
            Assert.AreEqual(3, stack.Min());
            stack.Push(2);
            Assert.AreEqual(2, stack.Min());
        }

        [TestMethod]
        public void MinimumValueNegativeNumberTest() {
            var stack = new FlashStack();
            stack.Push(3);
            Assert.AreEqual(3, stack.Min());
            stack.Push(5);
            Assert.AreEqual(3, stack.Min());
            stack.Push(-1);
            Assert.AreEqual(-1, stack.Min());
        }

        [TestMethod]
        public void MinimumValuePopedTest() {
            var stack = new FlashStack();
            stack.Push(3);
            Assert.AreEqual(3, stack.Min());
            stack.Push(5);
            Assert.AreEqual(3, stack.Min());
            stack.Push(2);
            Assert.AreEqual(2, stack.Min());
            Assert.AreEqual(2, stack.Pop());

            Assert.AreEqual(3, stack.Min());
        }

        [TestMethod]
        public void MinimumValueNegativePopedTest() {
            var stack = new FlashStack();
            stack.Push(3);
            Assert.AreEqual(3, stack.Min());
            stack.Push(5);
            Assert.AreEqual(3, stack.Min());
            stack.Push(-2);
            Assert.AreEqual(-2, stack.Min());
            Assert.AreEqual(-2, stack.Pop());

            Assert.AreEqual(3, stack.Min());
        }

        [TestMethod]
        public void OnlyPositivesTest() {
            var stack = new FlashStack();
            stack.Push(30);
            stack.Push(5);
            stack.Push(200);

            Assert.AreEqual(5, stack.Min());

            stack.Pop();

            Assert.AreEqual(5, stack.Min());

            stack.Pop();
            Assert.AreEqual(30, stack.Min());
        }

        [TestMethod]
        public void OnlyNegativeTest() {
            var stack = new FlashStack();
            stack.Push(-3);
            stack.Push(-5);
            stack.Push(-2);

            Assert.AreEqual(-5, stack.Min());

            stack.Pop();

            Assert.AreEqual(-5, stack.Min());

            stack.Pop();
            Assert.AreEqual(-3, stack.Min());
        }

    }
}
