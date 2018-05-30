using System;
using System.Collections.Generic;
using System.Text;
using System.Threading.Tasks;

namespace ConstructionStore.Domain {
    public interface IUnitOfWork {
        Task Commit();
    }
}
