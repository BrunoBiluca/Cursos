package tp2;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;

public class Reserva{
	int codigoCliente;
	Date entrada;
	Date saida;
	SimpleDateFormat data =  new SimpleDateFormat ("dd/MM/yyyy");
	//private Scanner input; 
	
	public Reserva(String inicio, String termino, int codigo){
		String dataEntrada = inicio;
		String dataSaida = termino;

		try{
			this.codigoCliente = codigo;
			this.setEntrada(data.parse(dataEntrada));
			this.setSaida(data.parse(dataSaida));
		}catch(ParseException e){
			System.out.println("Erro na leitura");
		}
		System.out.println("Reserva concluida com sucesso!");
	}

	public Date getSaida() {
		return saida;
	}

	public void setSaida(Date saida) {
		this.saida = saida;
	}

	public Date getEntrada() {
		return entrada;
	}

	public void setEntrada(Date entrada) {
		this.entrada = entrada;
	}
}
