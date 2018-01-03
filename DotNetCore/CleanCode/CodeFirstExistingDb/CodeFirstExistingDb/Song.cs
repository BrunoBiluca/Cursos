namespace CodeFirstExistingDb
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;
    using System.ComponentModel.DataAnnotations.Schema;
    using System.Data.Entity.Spatial;

    public partial class Song
    {
        public int SongId { get; set; }

        public int AlbumId { get; set; }

        [Required]
        [StringLength(255)]
        public string Title { get; set; }

        public virtual Album Album { get; set; }
    }
}
