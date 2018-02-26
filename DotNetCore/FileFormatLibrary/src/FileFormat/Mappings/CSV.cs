namespace FileFormat.Mappings
{
    public class CSV : IMapping {
        public string GetMappingType() {
            return GetType().Name;
        }
    }
}