namespace FileFormat.Mappings {
    public class JSON : IMapping {
        public string GetMappingType() {
            return typeof(JSON).Name;
        }
    }
}