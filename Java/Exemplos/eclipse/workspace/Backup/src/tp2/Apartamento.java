package tp2;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public abstract class Apartamento {
	
	ArrayList<Reserva> reservas = new ArrayList<Reserva>();
	
	String tipo;
	int codigo;
	float diaria;
	int capacidade;
	boolean extra;	
	
	public void camaExtra() {
		this.extra = true;
		this.diaria += this.diaria*0.30f;
	}	
	
	public void imprimirApartamento(){
		System.out.println("Tipo"+this.tipo);
		System.out.println("Codigo"+this.codigo);
		System.out.println("Diaria"+this.diaria);
		System.out.println("Capacidade"+this.capacidade);
	}
	
	public void setReserva(){
		Reserva nova = new Reserva();
		reservas.add(nova);
	}	
	
	@SuppressWarnings("finally")
	public boolean disponibilidade(String in, String out, Apartamento ap){
		SimpleDateFormat formato = new SimpleDateFormat("dd/MM/yyyy");
		
		try{
			Date entrada = formato.parse(in);
			Date saida = formato.parse(out);
		
			for(Reserva item:reservas){
				Reserva date = item;
				if((entrada.compareTo(date.entrada) == entrada.compareTo(date.saida)) && (saida.compareTo(date.entrada)==-1)){
					return(true);
				}else{
					return(false);
				}
			}			
			
		}catch(ParseException e){
			System.out.println("Erro na leitura");
		}finally{
			return(false);
		}
		
	}	
		
}

class ApStandart extends Apartamento{
	
	public static int contadorAp = 0;	

	public ApStandart() {
		contadorAp++;
		this.tipo = "Standart";
		this.codigo = 100 + contadorAp; 
		this.diaria = 268.00f;
		this.capacidade = 2;
		this.extra = false;
	}
	
}

class ApVistaBosque extends Apartamento{
	
	static int contadorAp = 0;	

	public ApVistaBosque() {
		ApVistaBosque.contadorAp++;
		this.tipo = "ApVistaBosque";		
		this.codigo = 200 + contadorAp; 
		this.diaria = 315.00f;
		this.capacidade = 4;
		this.extra = false;
	}

}

class ApVistaVale extends Apartamento{
	
	static int contadorAp = 0;	
	
	public ApVistaVale() {
		ApVistaVale.contadorAp++;
		this.tipo = "ApVistaVale";
		this.codigo = 300 + contadorAp; 
		this.diaria = 353.00f;
		this.capacidade = 4;
		this.extra = false;
	}

}

class ApSuite extends Apartamento{
	
	static int contadorAp = 0;	
	
	public ApSuite() {
		ApSuite.contadorAp++;
		this.tipo = "Suite";
		this.codigo = 400 + contadorAp; 
		this.diaria = 498.00f;
		this.capacidade = 2;
		this.extra = false;
	}

}
