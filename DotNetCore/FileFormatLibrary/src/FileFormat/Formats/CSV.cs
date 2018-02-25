namespace FileFormat.Formats
{
    public class CSV : IFormat {
        public string GetMappingType() {
            return GetType().Name;
        }
    }
}