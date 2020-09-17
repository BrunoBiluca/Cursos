package tp2;

import java.util.ArrayList;
import java.util.Date;
import java.util.Scanner;

public class Principal {
	
	static ArrayList<Apartamento> aps = new ArrayList<Apartamento>();
	static ArrayList<Cliente> hospedes = new ArrayList<Cliente>();
	
	public static int apsCadastrados = 0;
	
	private static Scanner scanner;

	public static void main(String[] args) {
		
		int opcao;
		
		scanner = new Scanner(System.in);
		
		do{
			System.out.println("-----------------------------------------------------");
			System.out.println("Sistema Na Moita Resort Hotel");
			System.out.println("Nosso lema é Na Moita é mais gostoso");
			System.out.println("-----------------------------------------------------");
			System.out.println();
			System.out.println("1) Cadastrar Quarto");
			System.out.println("2) Check In");
			System.out.println("3) Check Out");
			System.out.println("4) Pesquisa");
			System.out.println("5) Histótico");
			System.out.println("0) Sair");
			System.out.println("-----------------------------------------------------");

			opcao = scanner.nextInt();
			
			switch(opcao){
				case 1: 
					 cadastrarQuarto();
					 break;
				case 2: 
					 checkin();
					 break;
				case 3: 
					 checkout();
					 break;		
				case 4:
					 pesquisa();
					 break;
				case 5:

					 break;					 
				case 0: 
					System.out.println("Falou meu fio");
					break;
				default: 
					System.out.println("Digita a porra do negócio certo");
					break;
			}
		}while(opcao != 0);
	}

	private static void pesquisa() {
		 System.out.println("O que você deseja pesquisar?");
		 System.out.println("1 - Cliente");
		 System.out.println("2 - Apartamento");
		 int opcao = scanner.nextInt();
		 if(opcao == 1){
			 pesquisaCliente();
		 }
		 else if(opcao == 2){
			 pesquisaQuarto();
		 }
	}

	public static void cadastrarQuarto(){
		
		if(apsCadastrados <= 10){	
			
			System.out.println("Deseja cadastrar qual tipo de quarto?");
			System.out.println("- Standard");
			System.out.println("- Vista do Bosque");
			System.out.println("- Vista do Vale");
			System.out.println("- Suite");
			String opcao = scanner.next();
			
			if(opcao == "Standard"){
				Apartamento apartamento = new ApStandart();
				System.out.println("O preço é x, confirma? (s/n)");
				if(scanner.next().equals("s")) {
					aps.add(apartamento);
					apsCadastrados++;
				}				
			}
			else if(opcao == "Vista do Bosque"){
				Apartamento apartamento = new ApVistaBosque();
				System.out.println("O preço é x, confirma? (s/n)");
				if(scanner.next().equals("s")) {	
					aps.add(apartamento);
					apsCadastrados++;
				}	
			}
			else if(opcao == "Vista do Vale"){
				Apartamento apartamento = new ApVistaVale();
				System.out.println("O preço é x, confirma? (s/n)");
				if(scanner.next().equals("s")) {
					aps.add(apartamento);
					apsCadastrados++;
				}	
			}
			else if(opcao == "Suite"){
				Apartamento apartamento = new ApSuite();
				System.out.println("O preço é x, confirma? (s/n)");
				if(scanner.next().equals("s")) {
					aps.add(apartamento);
					apsCadastrados++;
				}	
			}
			else{
				System.out.println("Tipo errado");
			}
		}else{
			System.out.println("Não é possível cadastrar mais quartos");
			System.out.println("Como o hotel só tem um prédio não da para fazer milagre");
		}
		//aps.get(0).imprimirApartamento();
	}
	
	public static void checkin(){ 
		Cliente cliente = new Cliente();
		int[] apsDisp = new int[10];
		int i = 0;
		hospedes.add(cliente);
		
		System.out.println("Entre com o dia de início da reserva");
		String inicio = scanner.next();
		System.out.println("Entre com o dia de término da reserva");
		String termino = scanner.next();
		
		for(Apartamento item:aps){ 
			if(item.disponibilidade(inicio, termino, item)){
				apsDisp[i] = item.codigo;
				i++;
				item.imprimirApartamento();
			}
		}
		
		System.out.println("Qual apartamento você deseja alugar?");
		for(Apartamento item:aps){ 
			if(item.disponibilidade(inicio, termino, item)){
				apsDisp[i] = item.codigo;
				i++;
				item.imprimirApartamento();
			}
		}
		
			
	}
	
	public static void checkout(){
		
		float valorDiaria = 0;
		boolean camaExtra = false;
		
		System.out.println("Forneça o código do quarto para remoção:");
		int codigoApart = scanner.nextInt();
		int numQuarto = 0;
		Date in;
		Date out;
		for(Apartamento ap:aps){ 
			if(ap.codigo == codigoApart){
				// item. data de saida
				// calcula valor estadia
				numQuarto = ap.codigo;
				valorDiaria= ap.diaria;
				camaExtra = ap.extra;
				
			}
		}
		
		double estadia = diferencaDeDias(Date dataSaida,Date dataEntrada);
		for(Cliente c:hospedes) {
			if(c.codigo == codigoApart){
				System.out.println("Nome: "  + c.nome);
				System.out.println("Código: " + c.codigo);
			}
		}
		
		System.out.println("Número do quarto: " + numQuarto);
		System.out.println("Diária: "+ valorDiaria);
		if(camaExtra) {
			System.out.println("Acréscimo de cama extra." );
		}

		
	}
	
	public double diferencaDeDias(Date dataSaida,Date dataEntrada) {
		long aux = dataSaida.getTime() - dataEntrada.getTime();
		double dias  = aux/86400000;
		return (dias);
	}
	
	public static void pesquisaCliente(){
		System.out.println("Entre com o nome do cliente a ser pesquisado:");
		String nome = scanner.next();
		
		for(Cliente item:hospedes){
			if(item.nome.equals(nome)){
				item.imprimirCliente();
			}
		}
	}
	
	public static void pesquisaQuarto(){
		System.out.println("Entre com o código do apartamento a ser pesquisado:");
		int codigo = scanner.nextInt();
		
		for(Apartamento item:aps){
			if(item.codigo == codigo){
				item.imprimirApartamento();
			}
		}
	}
	
}
