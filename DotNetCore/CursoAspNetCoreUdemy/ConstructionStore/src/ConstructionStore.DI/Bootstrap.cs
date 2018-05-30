using System;
using System.Runtime.CompilerServices;
using ConstructionStore.Data;
using ConstructionStore.Domain;
using ConstructionStore.Domain.Product;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.DependencyInjection;

namespace ConstructionStore.DI {
    public class Bootstrap {
        public static void Configure(IServiceCollection services, string connection) {
            services.AddDbContext<ApplicationDbContext>(options => options.UseSqlServer(connection));
            // Esta configuração permite configurar de forma genérica qual o repositório que será passado
            services.AddScoped(typeof(IRepository<>), typeof(Repository<>));
            services.AddScoped(typeof(CategoryStorer));
            services.AddScoped(typeof(IUnitOfWork), typeof(UnitOfWork));
        }
    }
}
