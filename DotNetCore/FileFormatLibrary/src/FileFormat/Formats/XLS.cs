namespace FileFormat.Formats
{
    public class XLS : IFormat {
        public string GetMappingType() {
            return typeof(XLS).Name;
        }
    }
}