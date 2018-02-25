namespace FileFormat.Formats
{
    public class XML : IFormat {
        public string GetMappingType() {
            return typeof(XML).Name;
        }
    }
}