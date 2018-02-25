namespace FileFormat.Formats
{
    public class PDF : IFormat {
        public string GetMappingType() {
            return typeof(PDF).Name;
        }
    }
}