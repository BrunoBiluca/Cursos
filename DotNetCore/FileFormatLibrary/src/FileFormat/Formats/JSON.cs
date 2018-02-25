using FileFormat.Formats;

namespace FileFormat.Formats {
    public class JSON : IFormat {
        public string GetMappingType() {
            return typeof(JSON).Name;
        }
    }
}