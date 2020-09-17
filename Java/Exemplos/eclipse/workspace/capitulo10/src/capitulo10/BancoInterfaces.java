package capitulo10;

abstract class Conta {
	protected double saldo;

	public void deposita(double valor) {
		this.saldo += valor - 0.10f;
	}

	public void saca(double valor) {
		this.saldo -= valor;
	}

	public double getSaldo() {
		return this.saldo;
	}

	abstract void atualiza(double taxa);

}

interface Tributavel {
	double calculaTributo();
}

class ContaCorrente extends Conta implements Tributavel {
	public void atualiza(double taxa) {
		this.saldo += this.saldo * taxa * 2;
	}
	
	public double calculaTributo() {
		return this.saldo*0.1f;
	}
}

class SeguroVida implements Tributavel{
	
	public double calculaTributo() {
		return 42;
	}
}

class ContaPoupanca extends Conta {

	void atualiza(double taxa) {
		this.saldo += this.saldo * taxa * 3;
	}

}

class AtualizadorContas {
	private double saldoTotal = 0;
	private double selic;

	AtualizadorContas(double selic) {
		this.selic = selic;
	}

	void roda(Conta c) {
		System.out.println("Saldo anterior : " + c.getSaldo());
		c.atualiza(this.selic);
		System.out.println("Saldo Final : " + c.getSaldo());
		this.saldoTotal += c.getSaldo();
	}

	public double getSaldoTotal() {
		return saldoTotal;
	}

}

class GerenciadorDeImpostoDeRenda{
	private double total;
	
	void adiciona(Tributavel t){
		System.out.println("Adicionando tributável "+ t);
		
		this.total += t.calculaTributo();
	}
	
	double getTotal(){
		return this.total;
	}
}

public class BancoInterfaces {

	public static void main(String[] args) {
		
		GerenciadorDeImpostoDeRenda gerenciador = new GerenciadorDeImpostoDeRenda();
		
		SeguroVida sv = new SeguroVida();
		gerenciador.adiciona(sv);
		
		ContaCorrente cc = new ContaCorrente();
		cc.deposita(1000);
		gerenciador.adiciona(cc);
		
		//Tributavel t = cc;
		//System.out.println(t.calculaTributo());
		
		System.out.printf("O saldo é: %.2f", gerenciador.getTotal());
	}
}
