namespace FileFormat.Mappings
{
    public class XML : IMapping {
        public string GetMappingType() {
            return typeof(XML).Name;
        }
    }
}