namespace FileFormat.Mappings
{
    public class XLS : IMapping {
        public string GetMappingType() {
            return typeof(XLS).Name;
        }
    }
}