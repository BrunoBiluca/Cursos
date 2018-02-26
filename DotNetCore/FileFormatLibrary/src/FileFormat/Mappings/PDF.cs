namespace FileFormat.Mappings
{
    public class PDF : IMapping {
        public string GetMappingType() {
            return typeof(PDF).Name;
        }
    }
}