namespace ConstructionStore.Domain.Product
{
    public class Product
    {
        public int Id {get; private set;}
        public string Name {get; private set;}
        public decimal Price {get; private set;}
        public int StockQuantity {get; private set;}
        public Category Category {get; private set;}

        public Product(string name, decimal price, int stockQuantity, Category category){
            ValidateValues(name, price, stockQuantity, category);
            SetProperties(name, price, stockQuantity, category);
        }

        public void Update(string name, decimal price, int stockQuantity, Category category){
            ValidateValues(name, price, stockQuantity, category);
            SetProperties(name, price, stockQuantity, category);
        }

        private void ValidateValues(string name, decimal price, int stockQuantity, Category category){
            DomainException.When(string.IsNullOrEmpty(name), "Name is required");
            DomainException.When(price < 0, "Price is required");
            DomainException.When(stockQuantity < 0, "StockQuantity is required");
            DomainException.When(category == null, "Category is required");
        }

        private void SetProperties(string name, decimal price, int stockQuantity, Category category){
            Name = name;
            Price = price;
            StockQuantity = stockQuantity;
            Category = category;
        }
    }
}