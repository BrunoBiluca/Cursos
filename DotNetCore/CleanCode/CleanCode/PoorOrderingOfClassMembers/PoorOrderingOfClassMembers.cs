using System;
using System.Collections.Generic;
using System.Text;

namespace CleanCode.PoorOrderingOfClassMembers
{
    class PoorOrderingOfClassMembers
    {

        public PoorOrderingOfClassMembers(DateTime startTime, DateTime endTime, IEncoderApi encoderApi)
        {
            _startTime = startTime;
            _endTime = endTime;
            _encoderApi = encoderApi;
            if (_endTime > DateTime.Now.AddDays(1).Date)
            {
                _endTime = DateTime.Now.AddDays(1).Date;
            }
            _clientHelper = new SoapClientHelper();
        }

        private static Job ToJob(JobDefinition definition)
        {
            return new Job
            {
                Id = definition.Id,
                AuthId = definition.AuthId,
                ContextId = definition.ContextId
            };
        }

        public Dictionary<string, int> Dictionary
        {
            get { return new Dictionary<string, int>(); }
        }

        private IEnumerable<int> ProcessJobs()
        {
            return null;
        }

        private int CreateExceptions(Job job, User user, DateTime startTime, DateTime endTime)
        {
            return 0;
        }

        public int CreateExecutionPlan(Job job, User user, DateTime startTime, DateTime endTime)
        {
            return 0;
        }

        public int CreatePendingPlan(Job job, User user, DateTime startTime, DateTime endTime)
        {
            return 0;
        }

        private DateTime _startTime;

        private DateTime _endTime;
        private IEncoderApi _encoderApi;

        public int ContextId { get; set; }
        public int PlanId { get; set; }

        private readonly SoapClientHelper _clientHelper;


        public IEnumerable<UpdatedJob> UpdateJob(Job job, HashSet<int> requestIds)
        {
            return null;
        }
    }

    internal class UpdatedJob
    {
    }

    internal static class EncodingQueue
    {
        public static void Enqueue(object context, Encoder encoder, object user)
        {
            throw new NotImplementedException();
        }
    }

    internal class CreateJob
    {
        public CreateJob(Job job, User user, IEncoderApi encoderApi)
        {
        }
    }

    internal class EncodingLog
    {
        public static void LogMessage(string message)
        {
        }
    }

    internal class User
    {
    }

    internal class RequestHelper
    {
        public static void SetRequestHandler(RequestHandler requestHandler)
        {
        }
    }

    internal class RequestHandler
    {
        public RequestHandler(VideoConfig config)
        {
        }
    }

    internal class VideoConfig
    {
    }

    internal class Job
    {
        public int Id { get; set; }
        public object AuthId { get; set; }
        public object ContextId { get; set; }
    }

    internal class JobDefinition
    {
        public object ContextId { get; set; }
        public object AuthId { get; set; }
        public int Id { get; set; }
    }

    internal interface IComponentContext
    {
    }

    internal class SoapClientHelper
    {
    }

    internal interface IEncoderApi
    {
        IEnumerable<Encoder> GetAvailableEncoders(object contextId);
        void ListMobileEncoders(object contextId);
        object GetEncoder(object authId);
        object Complete(List<Job> jobs);
    }
}
