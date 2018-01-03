
namespace CleanCode.SwitchStatements
{
    public class Customer
    {
        public CustomerType Type { get; set; }
    }

    public enum CustomerType
    {
        PayAsYouGo = 1,
        Unlimited
    }
}
