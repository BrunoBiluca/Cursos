using System;

namespace FileFormat.Mappings
{
    public static class MappingFactory
    {
        /// <summary>
        /// Get the corresponding Mapping class for a file extension
        /// </summary>
        public static IMapping GetMapping(string fileExtension) {
            var formatsNamespace = typeof(IMapping).Namespace;
            var type = Type.GetType($"{formatsNamespace}.{fileExtension.ToUpper()}");
            FileFormatException.When(type == null, "File is not supported");

            return (IMapping)Activator.CreateInstance(type);
        } 
    }
}
