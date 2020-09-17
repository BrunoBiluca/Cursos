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
	boolean ocupado;
	boolean extra;
	Date entrada;
	Date saida;


	Cliente cliente;
	
	public void camaExtra() {
		this.diaria += this.diaria*0.30f;
		this.extra = true;
	}	
	
	public static double diferencaDeDias(Date dataSaida,Date dataEntrada) {
		long aux = dataSaida.getTime() - dataEntrada.getTime();
		double dias  = aux/86400000;
		return (dias);
	}		
	
	public void imprimirApartamento(){
		System.out.println("Tipo: "+this.tipo);
		System.out.println("Codigo: "+this.codigo);
		System.out.println("Diaria: "+this.diaria);
		System.out.println("Capacidade: "+this.capacidade);
	}	

	public void imprimirApartamento2(){
		double estadia = diferencaDeDias(this.saida, this.entrada);		
		double valorDiarias = this.diaria*estadia;
		System.out.println("Tipo: "+this.tipo);
		System.out.println("Codigo: "+this.codigo);
		System.out.println("Diaria: "+valorDiarias);
		System.out.println("Capacidade: "+this.capacidade);
	}	
	
	
	public boolean disponibilidade(String in, String out, Apartamento ap){
		SimpleDateFormat formato = new SimpleDateFormat("dd/MM/yyyy");
		boolean retorno = false;
		int cont = 0; //Quando não existem reservas
		
		try{
			Date entrada = formato.parse(in);
			Date saida = formato.parse(out);
			
			for(Reserva item:reservas){
				Reserva date = item;
				if((entrada.compareTo(date.saida) == saida.compareTo(date.entrada))){
					retorno = true;
				}else{
					retorno = false;
				}
				cont++;
			}		
			
			if(cont == 0){
				retorno = true;
			}
			
		}catch(ParseException e){
			System.out.println("Erro na leitura");
			retorno = false;
		}
		return retorno;		
	}

	public void setReserva(String inicio, String termino,int codigo) {
		Reserva nova = new Reserva(inicio,termino,codigo);
		reservas.add(nova);
	}	
		
}



class ApStandard extends Apartamento{
	
	public static int contadorAp = 0;	

	public ApStandard() {
		contadorAp++;
		this.tipo = "Standard";
		this.codigo = 100 + contadorAp; 
		this.diaria = 268.00f;
		this.capacidade = 2;
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
	}

}
