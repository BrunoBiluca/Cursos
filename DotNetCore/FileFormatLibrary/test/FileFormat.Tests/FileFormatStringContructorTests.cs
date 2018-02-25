using Microsoft.VisualStudio.TestTools.UnitTesting;

namespace FileFormat.Tests {
    [TestClass]
    public class FileFormatStringConstructorTests {
        [TestMethod]
        public void GetErrorBySendInvalidFilePath() {
            var fileFormat = new FileFormat("file");
            Assert.ThrowsException<FileFormatException>(() => fileFormat.MappingName());
        }

        [TestMethod]
        public void GetErrorBySendNotSupportedFile() {
            var fileFormat = new FileFormat("file.not");
            Assert.ThrowsException<FileFormatException>(() => fileFormat.MappingName());
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendCsvFile() {
            var fileFormat = new FileFormat("~/file.csv").MappingName();

            Assert.AreEqual("CSV", fileFormat);
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendPdfFile() {
            var fileFormat = new FileFormat("~/file.pdf").MappingName();

            Assert.AreEqual("PDF", fileFormat);
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendXmlFile() {
            var fileFormat = new FileFormat("~/file.xml").MappingName();

            Assert.AreEqual("XML", fileFormat);
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendJsonFile() {
            var fileFormat = new FileFormat("~/file.json").MappingName();

            Assert.AreEqual("JSON", fileFormat);
        }

        [TestMethod]
        public void GetJsonMappingTypeBySendXlsFile() {
            var fileFormat = new FileFormat("~/file.xls").MappingName();

            Assert.AreEqual("XLS", fileFormat);
        }
    }
}
