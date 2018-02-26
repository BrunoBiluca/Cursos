using System;
using System.Collections.Generic;
using System.Text;

namespace FileFormat
{
    /// <summary>
    /// Represents errors that occur when wrong files formats are send
    /// </summary>
    public class FileFormatException : Exception
    {
        public FileFormatException(string error) : base(error) { }

        public static void When(bool hasError, string errorMessage) {
            if (hasError)
                throw new FileFormatException(errorMessage);
        }
    }
}
