namespace ConstructionStore.Domain.Product
{
    // Utilizando a abordagem de Rich Class, o contrário de classes anêmicas
    public class Category : Entity
    {
        public string Name {get; private set;}

        public Category(string name){
            ValidateValues(name);
            SetProperties(name);
        }

        public void Update(string name){
            ValidateValues(name);
            SetProperties(name);
        }

        public void ValidateValues(string name){
            DomainException.When(string.IsNullOrEmpty(name), "Name is Required");
            DomainException.When(name != null && name.Length < 3, "Name need at least 3 characters");
        }

        public void SetProperties(string name){
            Name = name;
        }
    }
}