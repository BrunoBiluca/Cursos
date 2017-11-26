using System;
using System.Collections.Generic;
using System.Text;

/// <summary>
/// Namespace exemplo para organizar as classes do Specification Pattern
/// </summary>
namespace Filter_Example {
    public interface ISpecification<T> {
        bool IsSatisfied(T t);
    }

    public class SizeSpecification : ISpecification<Product> {

        private Size size;

        public SizeSpecification(Size size) {
            this.size = size;
        }

        public bool IsSatisfied(Product t) {
            return t.Size == size;
        }
    }

    public class ColorSpecification : ISpecification<Product> {
        private Color color;

        public ColorSpecification(Color color) {
            this.color = color;
        }

        public bool IsSatisfied(Product t) {
            return t.Color == color;
        }
    }

    public class AndSpecification<T> : ISpecification<T> {

        private ISpecification<T> first;
        private ISpecification<T> second;

        public AndSpecification(ISpecification<T> first, ISpecification<T> second) {
            this.first = first ?? throw new ArgumentNullException(paramName: nameof(first));
            this.second = second ?? throw new ArgumentNullException(paramName: nameof(second));
        }

        public bool IsSatisfied(T t) {
            return first.IsSatisfied(t) && second.IsSatisfied(t);
        }
    }

}
