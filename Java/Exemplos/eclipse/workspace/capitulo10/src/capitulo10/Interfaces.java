package capitulo10;

interface AreaCalculavel{
	double calcularArea();
}

class Quadrado implements AreaCalculavel{
	
	double lado;
	
	public Quadrado(double lado){
		this.lado = lado;
	}

	public double calcularArea() {
		return this.lado * this.lado;
	}
	
}

class Retangulo implements AreaCalculavel{
	double altura, largura;
	
	public Retangulo(double altura, double largura){
		this.altura = altura;
		this.largura = largura;
	}
	
	public double calcularArea() {
		return this.altura*this.largura;
	}
}

class Circulo implements AreaCalculavel{
	double raio;
	
	public Circulo(double raio){
		this.raio = raio;
	}
	
	@Override
	public double calcularArea() {
		return Math.PI * raio * raio;
	}
}

public class Interfaces{
	public static void main(String[] args) {
		AreaCalculavel quadrado = new Quadrado(10);
		AreaCalculavel retangulo = new Retangulo(9,10);
		
		System.out.println("Quadrado "+ quadrado.calcularArea());
		System.out.println("Retangulo "+ retangulo.calcularArea());
	}
}