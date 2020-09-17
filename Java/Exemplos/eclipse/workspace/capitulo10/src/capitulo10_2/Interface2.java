package capitulo10_2;

interface Conta {

	public void deposita(double valor);

	public void saca(double valor);

	public double getSaldo();

	abstract void atualiza(double taxa);

}

interface Tributavel {
	double calculaTributo();
}

interface ContaTributavel extends Conta, Tributavel {

}

class ContaCorrente implements ContaTributavel {

	private double saldo;

	public void atualiza(double taxa) {
		this.saldo += this.saldo * taxa * 2;
	}

	public double calculaTributo() {
		return this.saldo * 0.1f;
	}

	public void deposita(double valor) {
		if(valor < 0){
			throw new IllegalArgumentException();
		} else {
			this.saldo += valor - 0.10f;
		}	
	}

	public void saca(double valor) {
		if (this.saldo < valor) {
			throw new IllegalArgumentException("Saldo insuficiente");
		} else {
			this.saldo -= valor;
		}
	}

	public double getSaldo() {
		return this.saldo;
	}
}

class SeguroVida implements Tributavel {

	public double calculaTributo() {
		return 42;
	}
}

class ContaPoupanca implements Conta {

	private double saldo;

	public void atualiza(double taxa) {
		this.saldo += this.saldo * taxa * 3;
	}

	public void deposita(double valor) {
		if(valor < 0){
			throw new IllegalArgumentException("Valor ilegal de deposito");
		} else {
			this.saldo += valor;
		}	
	}

	public void saca(double valor) {
		this.saldo -= valor;
	}

	public double getSaldo() {
		return this.saldo;
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

class GerenciadorDeImpostoDeRenda {
	private double total;

	void adiciona(Tributavel t) {
		System.out.println("Adicionando tributável " + t);

		this.total += t.calculaTributo();
	}

	double getTotal() {
		return this.total;
	}
}

/*class SaldoInsuficienteException extends RuntimeException {

	SaldoInsuficienteException(String menssage) {
		super(menssage);
	}
	
}*/


public class Interface2 {

	public static void main(String[] args) {

		ContaTributavel cc = new ContaCorrente();
		cc.deposita(100);
		Conta cp = new ContaPoupanca();
		
		try{
			cp.deposita(-100);
			System.out.println("Me roubei porque sou burro");
		} catch (IllegalArgumentException e) {
			System.out.println(e.getMessage());
		}
		/*try {
			cc.saca(1000);
			System.out.println("Consegui sacar");
		} catch (IllegalArgumentException e) {
			System.out.println(e.getMessage());
		} finally {
			System.out.println("Fudeu geral");
		}*/

	}
}
