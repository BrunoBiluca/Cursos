using System;
using ConstructionStore.Domain.Product;
using Microsoft.EntityFrameworkCore;

namespace ConstructionStore.Data {
    public class ApplicationDbContext : DbContext {

        public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options) : base(options){

        }

        DbSet<Category> Categories {get; set;}
    }
}
