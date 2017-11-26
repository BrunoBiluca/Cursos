using System;
using System.Collections.Generic;
using System.Text;

/// <summary>
/// Classe exemplo para organizar os filtros criados para exemplificar o princípio do Open-Close
/// </summary>
namespace Filter_Example {
    public interface IFilter<T> {
        IEnumerable<T> Filter(IEnumerable<T> items, ISpecification<T> spec);
    }

    public class ProductFilter : IFilter<Product> {
        public IEnumerable<Product> Filter(IEnumerable<Product> items, ISpecification<Product> spec) {
            foreach(var i in items)
                if(spec.IsSatisfied(i))
                    yield return i;
        }
    }
}
