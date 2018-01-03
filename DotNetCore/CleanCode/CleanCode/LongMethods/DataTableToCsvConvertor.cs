using System;
using System.Data;
using System.IO;

namespace FooFoo
{
    public class DataTableToCsvConvertor
    {
        private StreamWriter _writer;
        private DataTable _dataTable;

        public string Convert(DataTable dataTable)
        {
            _dataTable = dataTable;

            using (var memoryStream = new MemoryStream())
            {
                _writer = new StreamWriter(memoryStream);
                WriteColumnNames();
                WriteRows();
                _writer.Close();

                return memoryStream.ToString();
            }
        }

        private void WriteRows()
        {
            foreach (DataRow dr in _dataTable.Rows)
            {
                for (int i = 0; i < _dataTable.Columns.Count; i++)
                {
                    WriteCell(dr, i);

                    if (i < _dataTable.Columns.Count - 1)
                        _writer.Write(",");
                }
                _writer.WriteLine();
            }
        }

        private void WriteCell(DataRow row, int columnIndex)
        {
            if (!System.Convert.IsDBNull(row[columnIndex]))
            {
                string str = String.Format((string) "\"{0:c}\"", (object) row[columnIndex].ToString()).Replace("\r\n", " ");
                _writer.Write(str);
            }
            else
            {
                _writer.Write("");
            }
        }

        private void WriteColumnNames()
        {
            for (int i = 0; i < _dataTable.Columns.Count; i++)
            {
                _writer.Write(_dataTable.Columns[i]);
                if (i < _dataTable.Columns.Count - 1)
                {
                    _writer.Write(",");
                }
            }
            _writer.WriteLine();
        }
    }
}