using System;
using System.Linq;

namespace CleanCode.PoorMethodSignatures
{
    public class PoorMethodSignatures
    {
        public void Run()
        {
            var userService = new UserService();

            var user = userService.GetUser("username", "password", true);
            var anotherUser = userService.GetUser("username", null, false);
        }
    }

    public class UserService
    {
        private UserDbContext _dbContext = new UserDbContext();

        public User GetUser(string username, string password, bool login)
        {
            if (login)
            {
                // Check if there is a user with the given username and password in db
                // If yes, set the last login date 
                // and then return the user. 
                var user = _dbContext.Users.SingleOrDefault(u => u.Username == username && u.Password == password);
                if (user != null)
                    user.LastLogin = DateTime.Now;
                return user;
            }
            else
            {
                // Check if there is a user with the given username
                // If yes, return it, otherwise return null
                var user = _dbContext.Users.SingleOrDefault(u => u.Username == username);
                return user;
            }
        }
    }

    public class UserDbContext : DbContext
    {
        public IQueryable<User> Users { get; set; }
    }

    public class DbSet<T>
    {
    }

    public class DbContext
    {
    }

    public class User
    {
        public string Username { get; set; }
        public string Password { get; set; }
        public DateTime LastLogin { get; set; }
    }
}
