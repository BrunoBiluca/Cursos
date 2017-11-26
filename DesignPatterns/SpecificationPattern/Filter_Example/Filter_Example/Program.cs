using System;
using System.Collections;
using System.Collections.Generic;

namespace Filter_Example {
    /// <summary>
    /// Exemplo simples do Specification Pattern para exemplificar o princípio Open-Close da metodologia SOLID
    /// Aberto para extensão e fechado para modificação
    /// </summary>

    public class Program {
        static void Main(string[] args) {

            var cuboMagico = new Product("cubo mágico", Color.Blue, Size.Small);
            var notebook = new Product("notebook", Color.Blue, Size.Medium);
            var almofada = new Product("alfomada", Color.Red, Size.Medium);
            var mesa = new Product("mesa", Color.Green, Size.Large);

            Product[] products = { cuboMagico, notebook, almofada, mesa };

            Console.WriteLine("Filtro por I'm blue");
            foreach(var p in new ProductFilter().Filter(products, new ColorSpecification(Color.Blue))) {
                Console.WriteLine($" - {p.Name} is blue");
            }

            Console.WriteLine("Filtro por I'm green and large");
            foreach(var p in new ProductFilter().Filter(products,
                    new AndSpecification<Product>(
                        new ColorSpecification(Color.Green),
                        new SizeSpecification(Size.Large)
                    )
                )
            ) {
                Console.WriteLine($" - {p.Name} is green and large");
            }


            Console.ReadKey();

        }
    }
}
