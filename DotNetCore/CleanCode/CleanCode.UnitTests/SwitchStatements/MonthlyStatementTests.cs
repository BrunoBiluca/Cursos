using CleanCode.SwitchStatements;
using Microsoft.VisualStudio.TestTools.UnitTesting;

namespace CleanCode.UnitTests.SwitchStatements
{
    [TestClass]
    public class MonthlyStatementTests
    {
        [TestMethod]
        public void PayAsYouGoCustomer_IsChargedBasedOnTheSumOfCostOfCallAndSms()
        {
            var customer = new Customer { Type = CustomerType.PayAsYouGo };
            var usage = new MonthlyUsage { CallMinutes = 100, SmsCount = 100, Customer = customer };
            var statement = new MonthlyStatement();
            statement.Generate(usage);

            Assert.AreEqual(12.0f, statement.CallCost);
            Assert.AreEqual(12.0f, statement.SmsCost);
            Assert.AreEqual(24.0f, statement.TotalCost);
        }

        [TestMethod]
        public void UnlimitedCustomer_IsChargedAFlatRatePerMonth()
        {
            var customer = new Customer { Type = CustomerType.Unlimited };
            var usage = new MonthlyUsage { CallMinutes = 100, SmsCount = 100, Customer = customer };
            var statement = new MonthlyStatement();
            statement.Generate(usage);

            Assert.AreEqual(0, statement.CallCost);
            Assert.AreEqual(0, statement.SmsCost);
            Assert.AreEqual(54.90f, statement.TotalCost);
        }
    }
}
