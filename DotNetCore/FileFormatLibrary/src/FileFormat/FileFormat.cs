using System;
using System.IO;
using System.Linq;
using System.Text.RegularExpressions;
using FileFormat.Mappings;

namespace FileFormat
{
    /// <summary>
    ///     The main File Format class
    ///     Contains all methods for determining mapping options given a file
    /// </summary>
    public class FileFormat {
        private const string RegexExtension = @"^\S+.[a-zA-Z]+[0-9]*$";
        private readonly string _fileExtension;

        public FileFormat(string filePath) {
            var regex = new Regex(RegexExtension);
            FileFormatException.When(!regex.Match(filePath).Success, "Invalid File path, the file doesn't have a extension");

            _fileExtension = filePath.Split('.').Last();
        }

        public FileFormat(FileStream file){
            _fileExtension = file.Name.Split('.').Last();
        }

        /// <summary>
        /// Função resposável por retornar o tipo de mapeamento do arquivo enviado
        /// </summary>
        /// <exception cref="FileFormatException">Arquivo não suportado</exception>
        /// <returns>Nome do mapeamento</returns>
        public string MappingName() {

            var format = MappingFactory.GetMapping(_fileExtension);
            return format?.GetMappingType();
        }
    }
}