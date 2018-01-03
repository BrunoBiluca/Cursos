
using System;
using System.Collections.Generic;

namespace CleanCode.LongParameterList
{
    public class LongParameterList
    {
        public IEnumerable<Reservation> GetReservations(
           DateTime dateFrom, DateTime dateTo,
           User user, int locationId,
           LocationType locationType, int? customerId = null)
        {
            if (dateFrom >= DateTime.Now)
                throw new ArgumentNullException("dateFrom");
            if (dateTo <= DateTime.Now)
                throw new ArgumentNullException("dateTo");

            throw new NotImplementedException();
        }

        public IEnumerable<Reservation> GetUpcomingReservations(
            DateTime dateFrom, DateTime dateTo,
            User user, int locationId,
            LocationType locationType)
        {
            if (dateFrom >= DateTime.Now)
                throw new ArgumentNullException("dateFrom");
            if (dateTo <= DateTime.Now)
                throw new ArgumentNullException("dateTo");

            throw new NotImplementedException();
        }

        private static Tuple<DateTime, DateTime> GetReservationDateRange(DateTime dateFrom, DateTime dateTo, ReservationDefinition sd)
        {
            if (dateFrom >= DateTime.Now)
                throw new ArgumentNullException("dateFrom");
            if (dateTo <= DateTime.Now)
                throw new ArgumentNullException("dateTo");

            throw new NotImplementedException();
        }

        public void CreateReservation(DateTime dateFrom, DateTime dateTo, int locationId)
        {
            if (dateFrom >= DateTime.Now)
                throw new ArgumentNullException("dateFrom");
            if (dateTo <= DateTime.Now)
                throw new ArgumentNullException("dateTo");

            throw new NotImplementedException();
        }
    }

    internal class ReservationDefinition
    {
    }

    public class LocationType
    {
    }

    public class User
    {
        public object Id { get; set; }
    }

    public class Reservation
    {
    }
}
