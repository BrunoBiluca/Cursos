
namespace CodeFirstExistingDb
{
    using System;
    using System.Data.Entity;
    using System.ComponentModel.DataAnnotations.Schema;
    using System.Linq;

    public partial class MusicStoreContext : DbContext
    {
        public MusicStoreContext()
            : base("name=MusicStoreContext")
        {
        }

        public virtual DbSet<Album> Albums { get; set; }
        public virtual DbSet<Song> Songs { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Album>()
                .Property(e => e.Title)
                .IsUnicode(false);

            modelBuilder.Entity<Album>()
                .Property(e => e.Artist)
                .IsUnicode(false);

            modelBuilder.Entity<Song>()
                .Property(e => e.Title)
                .IsUnicode(false);
        }
    }
}
