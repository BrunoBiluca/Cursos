using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using ConstructionStore.Domain;

namespace ConstructionStore.Data {
    public class Repository<TEntity> : IRepository<TEntity> where TEntity : Entity {

        private readonly ApplicationDbContext _context;

        public Repository(ApplicationDbContext context) {
            _context = context;
        }

        public TEntity GetById(int id) {
            // O Set determina qual o DBSet que será utilizado para fazer a query
            return _context.Set<TEntity>().SingleOrDefault(e => e.Id == id);
        }

        public void Save(TEntity entity) {
            _context.Set<TEntity>().Add(entity);
        }
    }
}
