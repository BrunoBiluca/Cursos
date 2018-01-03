namespace CodeFirstExistingDb.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class AddNumberOfDownloadsToAlbum : DbMigration
    {
        public override void Up()
        {
            AddColumn("dbo.Albums", "NumberOfDownloads", c => c.Int(nullable: false));
        }
        
        public override void Down()
        {
            DropColumn("dbo.Albums", "NumberOfDownloads");
        }
    }
}
