using System.Linq;

namespace CleanCode.FullRefactoring
{
    public class PostRepository
    {
        private readonly PostDbContext _dbContext;

        public PostRepository()
        {
            _dbContext = new PostDbContext();
        }

        public Post GetPost(int postId)
        {
            return _dbContext.Posts.SingleOrDefault(p => p.Id == postId);
        }

        public void SavePost(Post post)
        {
            _dbContext.Posts.Add(post);
            _dbContext.SaveChanges();
        }
    }
}

