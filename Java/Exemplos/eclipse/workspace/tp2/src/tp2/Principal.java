package tp2;

import java.util.ArrayList;
import java.util.Scanner;

public class Principal {
	
	static ArrayList<Apartamento> aps = new ArrayList<Apartamento>();
	static ArrayList<Cliente> hospedes = new ArrayList<Cliente>();
	
	private static Scanner scanner;

	public static void main(String[] args) {
		
		int opcao;
		
		scanner = new Scanner(System.in);
		
		do{
			System.out.println("-----------------------------------------------------");
			System.out.println("Sistema Na Moita Resort Hotel");
			System.out.println("Nosso lema é Na Moita é mais gostoso");
			System.out.println("Melhor hotel para viagens no tempo");
			System.out.println("-----------------------------------------------------");
			System.out.println();
			System.out.println("1) Cadastrar Quarto");
			System.out.println("2) Cadastrar Reservas");
			System.out.println("3) Check In");
			System.out.println("4) Check Out");
			System.out.println("5) Pesquisa");
			System.out.println("6) Histótico");
			System.out.println("0) Sair");
			System.out.println("-----------------------------------------------------");

			opcao = scanner.nextInt();
			
			switch(opcao){
				case 1: 
					 cadastrarQuarto();
					 break;
				case 2: 
					 reservas();
					 break;
				case 3: 
					 checkin();
					 break;		
				case 4:
					 checkout();
					 break;
				case 5:
					pesquisa();
					 break;
				case 6:
					historico();
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
		
		if(aps.size() <= 10){	
			
			System.out.println("Deseja cadastrar qual tipo de quarto?");
			System.out.println("- Standard");
			System.out.println("- Bosque");
			System.out.println("- Vale");
			System.out.println("- Suite");
			
			String opcao2 = scanner.next();
			
			if(opcao2.equals("Standard")){
				Apartamento apartamento = new ApStandard();
				aps.add(apartamento);
			}
			else if(opcao2.equals("Bosque")){
				Apartamento apartamento = new ApVistaBosque();
				aps.add(apartamento);
			}
			else if(opcao2.equals("Vale")){
				Apartamento apartamento = new ApVistaVale();
				aps.add(apartamento);
			}
			else if(opcao2.equals("Suite")){
				Apartamento apartamento = new ApSuite();
				aps.add(apartamento);
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
	
	public static void reservas(){
		System.out.println("Primeiramente cadastre o cliente");
		System.out.print("Nome: ");
		String nome = scanner.next(); 
		System.out.print("CPF: ");
		String cpf = scanner.next();
		System.out.println("Codigo: ");
		int codigo = scanner.nextInt();
		Cliente cliente = new Cliente(nome,cpf,codigo);
		
		System.out.println("Entre com o dia de início da reserva");
		String inicio = scanner.next();
		System.out.println("Entre com o dia de término da reserva");
		String termino = scanner.next();

		boolean existe = false;
		for(Apartamento item:aps){ 
			if(item.disponibilidade(inicio, termino, item)){
				item.imprimirApartamento();
				existe = true;
			}
		}	
		
		if(existe){
		System.out.println("Qual apartamento você deseja alugar?");
		int numAp = scanner.nextInt();
		for(Apartamento item:aps){ 
			if(item.codigo == numAp){
				item.setReserva(inicio, termino, codigo);
				cliente.numQuarto = item.codigo;
			}
		}
		}else{System.out.println("Não existem apartamentos disponíveis");}
		hospedes.add(cliente);		
	}
	
	public static void checkin(){ 
		System.out.println("Qual o código do cliente");
		int codigo = scanner.nextInt();
			
		for(Apartamento item:aps){
			for(Reserva item2:item.reservas){ 
				if(item2.codigoCliente == codigo){
					item.entrada = item2.entrada;
					System.out.println("entrada "+item.entrada);
					item.saida = item2.saida;
					System.out.println("saida "+item.saida);
					item.ocupado = true;
				}
			}		
		}		

	}
	
	public static void checkout(){
		boolean camaExtra = false;
		
		System.out.println("Forneça o código do quarto para remoção:");
		int codigoApart = scanner.nextInt();
		for(Apartamento ap:aps){ 
			if(ap.codigo == codigoApart){
				ap.imprimirApartamento2();
				// item. data de saida
				// calcula valor estadia
				camaExtra = ap.extra;
			}
		}
		
		if(camaExtra) {
			System.out.println("Acréscimo de cama extra." );
		}		
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

	public static void historico(){
		System.out.println("Quantidade de apartamentos "+aps.size());
		
		int numOcupados = 0;
		for(Apartamento item:aps){
			if(item.ocupado){
				numOcupados++;
			}
		}
		System.out.println("Números de quartos ocupados: "+numOcupados++);
	}
	
}

