using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.IO;
using System.Configuration;
using System.Data.SqlClient;
using System.Data;

namespace FooFoo
{
    public partial class Download : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            System.IO.MemoryStream ms = CreateMemoryFile();

            byte[] byteArray = ms.ToArray();
            ms.Flush();
            ms.Close();

            Response.Clear();
            Response.ClearContent();
            Response.ClearHeaders();
            Response.Cookies.Clear();
            Response.Cache.SetCacheability(HttpCacheability.Private);
            Response.CacheControl = "private";
            Response.Charset = System.Text.UTF8Encoding.UTF8.WebName;
            Response.ContentEncoding = System.Text.UTF8Encoding.UTF8;
            Response.AppendHeader("Pragma", "cache");
            Response.AppendHeader("Expires", "60");
            Response.ContentType = "text/comma-separated-values";
            Response.AddHeader("Content-Disposition", "attachment; filename=FooFoo.csv");
            Response.AddHeader("Content-Length", byteArray.Length.ToString());
            Response.BinaryWrite(byteArray);
        }

        public System.IO.MemoryStream CreateMemoryFile()
        {
            MemoryStream ReturnStream = new MemoryStream();

            try
            {
                string strConn = ConfigurationManager.ConnectionStrings["FooFooConnectionString"].ToString();
                SqlConnection conn = new SqlConnection(strConn);
                SqlDataAdapter da = new SqlDataAdapter("SELECT * FROM [FooFoo] ORDER BY id ASC", conn);
                DataSet ds = new DataSet();
                da.Fill(ds, "FooFoo");
                DataTable dt = ds.Tables["FooFoo"];

                //Create a streamwriter to write to the memory stream
                StreamWriter sw = new StreamWriter(ReturnStream);

                int iColCount = dt.Columns.Count;

                for (int i = 0; i < iColCount; i++)
                {
                    sw.Write(dt.Columns[i]);
                    if (i < iColCount - 1)
                    {
                        sw.Write(",");
                    }
                }

                sw.WriteLine();
                int intRows = dt.Rows.Count;

                // Now write all the rows.
                foreach (DataRow dr in dt.Rows)
                {
                    for (int i = 0; i < iColCount; i++)
                    {

                        if (!Convert.IsDBNull(dr[i]))
                        {
                            string str = String.Format("\"{0:c}\"", dr[i].ToString()).Replace("\r\n", " ");
                            sw.Write(str);
                        }
                        else
                        {
                            sw.Write("");
                        }

                        if (i < iColCount - 1)
                        {
                            sw.Write(",");
                        }
                    }
                    sw.WriteLine();
                }

                sw.Flush();
                sw.Close();
            }
            catch (Exception Ex)
            {
                throw Ex;
            }
            return ReturnStream;
        }

    }
}