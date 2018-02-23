using ConstructionStore.Domain.DTOs;

namespace ConstructionStore.Domain.Product
{
    public class ProductStorer
    {
        private readonly IRepository<Product> _productRepository;
        private readonly IRepository<Category> _categoryRepository;

        public ProductStorer(IRepository<Product> productRepository, IRepository<Category> categoryRepository){
            _productRepository = productRepository;
            _categoryRepository = categoryRepository;
        }

        public void Store(ProductDto dto){
            var category = _categoryRepository.GetById(dto.CategoryId);
            DomainException.When(category == null, "Category invalid");

            var product = _productRepository.GetById(dto.Id);
            if(product == null){
                product = new Product(dto.Name, dto.Price, dto.StockQuantity, category);
                _productRepository.Save(product);
            }
            else
                product.Update(dto.Name, dto.Price, dto.StockQuantity, category);
        }
    }
}