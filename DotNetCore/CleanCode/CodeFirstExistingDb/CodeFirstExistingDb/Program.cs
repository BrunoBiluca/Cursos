using System;

namespace CodeFirstExistingDb
{
    class Program
    {
        static void Main(string[] args)
        {
            using (var context = new MusicStoreContext())
            {
                var album = new Album()
                    {
                        AlbumId = 1,
                        Title = "a2",
                        PublishDate = DateTime.Now,
                        Artist = "asdasdasd"
                    };
                context.Albums.Attach(album);
                album.Title = "BOOM";

                var entries = context.ChangeTracker.Entries<Album>();
                foreach (var entry in entries)
                {
                    Console.WriteLine(entry.Entity.AlbumId);
                    Console.WriteLine(entry.CurrentValues["Title"]);
                    Console.WriteLine(entry.OriginalValues["Title"]);
                }

                context.SaveChanges();
            }


        }
    }
}
