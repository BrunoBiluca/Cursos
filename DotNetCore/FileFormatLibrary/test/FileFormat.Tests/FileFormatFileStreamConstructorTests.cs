using System.IO;
using Microsoft.VisualStudio.TestTools.UnitTesting;

namespace FileFormat.Tests {
    [TestClass]
    public class FileFormatFilestreamConstructorTests {

        [TestMethod]
        public void GetErrorBySendInvalidFileName() {
            using (var fileStream = File.Open("./Files/file", FileMode.Open)) {
                var fileFormat = new FileFormat(fileStream);
                Assert.ThrowsException<FileFormatException>(() => fileFormat.MappingName());                
            }
        }

        [TestMethod]
        public void GetErrorBySendNotSupportedFile() {
            using (var fileStream = File.Open("./Files/file.txt", FileMode.Open)) {
                var fileFormat = new FileFormat(fileStream);
                Assert.ThrowsException<FileFormatException>(() => fileFormat.MappingName());                
            }
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendCsvFile() {
            using (var fileStream = File.Open("./Files/file.csv", FileMode.Open)) {
                var fileFormat = new FileFormat(fileStream).MappingName();
                Assert.AreEqual("CSV", fileFormat);             
            }
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendPdfFile() {
            using (var fileStream = File.Open("./Files/file.pdf", FileMode.Open)) {
                var fileFormat = new FileFormat(fileStream).MappingName();
                Assert.AreEqual("PDF", fileFormat);                
            }
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendXmlFile() {
            using (var fileStream = File.Open("./Files/file.xml", FileMode.Open)) {
                var fileFormat = new FileFormat(fileStream).MappingName();
                Assert.AreEqual("XML", fileFormat);                
            }
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendJsonFile() {
            using (var fileStream = File.Open("./Files/file.json", FileMode.Open)) {
                var fileFormat = new FileFormat(fileStream).MappingName();
                Assert.AreEqual("JSON", fileFormat);               
            }
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendXlsFile() {
            using (var fileStream = File.Open("./Files/file.xls", FileMode.Open)) {
                var fileFormat = new FileFormat(fileStream).MappingName();
                Assert.AreEqual("XLS", fileFormat);                
            }
        }

    }
}
