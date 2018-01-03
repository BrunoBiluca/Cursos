using System.Drawing;

namespace CleanCode.Names {
    public class Names {
        public Bitmap GenerateImage(string filePath) {
            var bitmap = new Bitmap(filePath);
            var graphics = Graphics.FromImage(bitmap);
            graphics.DrawString("a", SystemFonts.DefaultFont, SystemBrushes.Desktop, new PointF(0, 0));
            graphics.DrawString("b", SystemFonts.DefaultFont, SystemBrushes.Desktop, new PointF(0, 20));
            graphics.DrawString("c", SystemFonts.DefaultFont, SystemBrushes.Desktop, new PointF(0, 30));
            return bitmap;
        }
    }
}
