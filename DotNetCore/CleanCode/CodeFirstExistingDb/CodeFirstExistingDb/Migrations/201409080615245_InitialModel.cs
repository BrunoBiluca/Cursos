namespace CodeFirstExistingDb.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class InitialModel : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.Albums",
                c => new
                    {
                        AlbumId = c.Int(nullable: false, identity: true),
                        Title = c.String(nullable: false, maxLength: 255, unicode: false),
                        PublishDate = c.DateTime(nullable: false, storeType: "smalldatetime"),
                        Artist = c.String(nullable: false, maxLength: 50, unicode: false),
                    })
                .PrimaryKey(t => t.AlbumId);
            
            CreateTable(
                "dbo.Songs",
                c => new
                    {
                        SongId = c.Int(nullable: false, identity: true),
                        AlbumId = c.Int(nullable: false),
                        Title = c.String(nullable: false, maxLength: 255, unicode: false),
                    })
                .PrimaryKey(t => t.SongId)
                .ForeignKey("dbo.Albums", t => t.AlbumId, cascadeDelete: true)
                .Index(t => t.AlbumId);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.Songs", "AlbumId", "dbo.Albums");
            DropIndex("dbo.Songs", new[] { "AlbumId" });
            DropTable("dbo.Songs");
            DropTable("dbo.Albums");
        }
    }
}
