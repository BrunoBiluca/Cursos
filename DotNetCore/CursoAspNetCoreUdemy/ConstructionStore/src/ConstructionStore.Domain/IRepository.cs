namespace ConstructionStore.Domain
{
    public interface IRepository<TEntity>
    {
         TEntity GetById(int id);
         void Save(TEntity entity);
    }
}