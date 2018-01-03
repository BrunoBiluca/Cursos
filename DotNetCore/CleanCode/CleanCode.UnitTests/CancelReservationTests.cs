using CleanCode.NestedConditionals;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using System;

namespace CleanCode.UnitTests
{
    [TestClass]
    public class CancelReservationTests
    {
        [TestMethod]
        public void GoldCustomer_CancellingMoreThan24Hours_ShouldCancel()
        {
            var customer = CreateGoldCustomer();
            var reservation = new Reservation(customer, DateTime.Now.AddHours(25));

            reservation.Cancel();

            Assert.IsTrue(reservation.IsCanceled);
        }

        [TestMethod]
        [ExpectedException(typeof(InvalidOperationException))]
        public void GoldCustomer_CancellingLessThan24HoursBefore_ShouldThrowException()
        {
            var customer = CreateGoldCustomer();
            var reservation = new Reservation(customer, DateTime.Now.AddHours(23));

            reservation.Cancel();
        }

        [TestMethod]
        [ExpectedException(typeof(InvalidOperationException))]
        public void GoldCustomer_CancellingAfterStartDate_ShouldThrowException()
        {
            var customer = CreateGoldCustomer();
            var reservation = new Reservation(customer, DateTime.Now.AddDays(-1));

            reservation.Cancel();
        }

        [TestMethod]
        public void RegularCustomer_CancellingMoreThan48HoursBefore_ShouldCancel()
        {
            var customer = CreateRegularCustomer();
            var reservation = new Reservation(customer, DateTime.Now.AddHours(49));

            reservation.Cancel();

            Assert.IsTrue(reservation.IsCanceled);
        }

        [TestMethod]
        [ExpectedException(typeof(InvalidOperationException))]
        public void RegularCustomer_CancellingLessThan48Hours_ShouldThrowException()
        {
            var customer = CreateRegularCustomer();
            var reservation = new Reservation(customer, DateTime.Now.AddHours(47));

            reservation.Cancel();
        }

        [TestMethod]
        [ExpectedException(typeof(InvalidOperationException))]
        public void RegularCustomer_CancellingAfterStartDate_ShouldThrowException()
        {
            var customer = CreateRegularCustomer();
            var reservation = new Reservation(customer, DateTime.Now.AddHours(-1));

            reservation.Cancel();
        }

        private static Customer CreateGoldCustomer()
        {
            return new Customer { LoyaltyPoints = 200 };
        }

        private static Customer CreateRegularCustomer()
        {
            return new Customer();
        }
    }
}
