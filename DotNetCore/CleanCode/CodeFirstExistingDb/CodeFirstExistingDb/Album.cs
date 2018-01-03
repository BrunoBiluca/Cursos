

namespace CodeFirstExistingDb
{
    using System;
    using System.Collections.Generic;
    using System.ComponentModel.DataAnnotations;
    using System.ComponentModel.DataAnnotations.Schema;

    public partial class Album
    {
        public Album()
        {
            Songs = new HashSet<Song>();
        }

        public int AlbumId { get; set; }

        [Required]
        [StringLength(255)]
        public string Title { get; set; }

        [Column(TypeName = "smalldatetime")]
        public DateTime PublishDate { get; set; }

        [Required]
        [StringLength(50)]
        public string Artist { get; set; }

        public int NumberOfDownloads { get; set; }

        public virtual ICollection<Song> Songs { get; set; }
    }
}
