package capitulo9;

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

class ContaCorrente extends Conta {
	public void atualiza(double taxa) {
		this.saldo += this.saldo * taxa * 2;
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

public class ClasseAbstrata {

	public static void main(String[] args) {

	}
}
