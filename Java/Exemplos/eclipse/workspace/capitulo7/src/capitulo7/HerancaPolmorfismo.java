package capitulo7;

class Conta {
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

	public void atualiza(double taxa) {
		this.saldo += this.saldo * taxa;
	}

}

class ContaCorrente extends Conta {
	public void atualiza(double taxa) {
		this.saldo += this.saldo * taxa * 2;
	}
}

class ContaPoupanca extends Conta {
	public void atualiza(double taxa) {
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

public class HerancaPolmorfismo {
	public static void main(String[] args) {
		Conta c = new Conta();
		Conta cc = new ContaCorrente();
		Conta cp = new ContaPoupanca();

		c.deposita(1000);
		cc.deposita(1000);
		cp.deposita(1000);

		AtualizadorContas adc = new AtualizadorContas(0.01);

		adc.roda(c);
		adc.roda(cc);
		adc.roda(cp);

		System.out.println("Saldo total: " + adc.getSaldoTotal());
	}
}