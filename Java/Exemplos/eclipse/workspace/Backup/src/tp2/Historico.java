package tp2;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Scanner;

class Reserva{
	Date entrada;
	Date saida;
	SimpleDateFormat data =  new SimpleDateFormat ("dd/MM/yyyy");
	private Scanner input; 
	
	public Reserva(){
		input = new Scanner(System.in);
		// salvando apartamento
		System.out.println("Data de entrada");
		String dataEntrada = input.next();
		System.out.println("Data de saida");
		String dataSaida = input.next();
		try{
			this.setEntrada(data.parse(dataEntrada));
			this.setSaida(data.parse(dataSaida));
		}catch(ParseException e){
			System.out.println("Erro na leitura");
		}
		
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

public class Historico {

}
