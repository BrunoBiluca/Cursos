namespace ConstructionStore.Domain.Product
{
    // Utilizando a abordagem de Rich Class, o contrário de classes anêmicas
    public class Category
    {
        public int Id {get; private set;}

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
        }

        public void SetProperties(string name){
            Name = name;
        }
    }
}