
namespace CleanCode.MagicNumbers
{
    public class MagicNumbers
    {
        public void ApproveDocument(int status)
        {
            if (status == 1)
            {
                // ...
            }
            else if (status == 2)
            {
                // ...
            }
        }

        public void RejectDoument(string status)
        {
            switch (status)
            {
                case "1":
                    // ...
                    break;
                case "2":
                    // ...
                    break;
            }
        }
    }
}
