/*
 * 		Simulador de Cache
 * 
 * 		Autores: Bruno Bernardes da Costa
 * 				 Michael Douglas de Campos
 * 
 * 		Entradas: ./tp1 -c tipo_Cache -t Tamanho_Cache -b Tamanho_Blocos_Cache -p Politica_Substituicao
 * 				tipo de cache = MD ou AC
 * 				tamanho de cache = 64, 128 ou 512
 * 				tamanho dos blocos = 1, 2 ou 4
 * 				politica de substituição: FIFO ou LRU
 * 
 *  	Para Associativa por Conjunto adicionar: -v Numero_de_Vias
 *  			Para cache totalmente associtativa colocar número de vias 1
 *  			Número de vias : 2 ou 4
 *  
 *  	Conversão inteiro para binário:
 *  
 *  		int x = 10;
			String[] qualquer = Integer.toBinaryString(x);
			System.out.println(qualquer);

 * 
 * */

package tp1_AOC;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.Calendar;

public class Principal{
	
	static int tamanhoMemoria = 2048;
	
	public static void main(String[] args) throws IOException{
		
		
		int[] memoria = new int[tamanhoMemoria];
		
		Cache cache = new Cache(args, tamanhoMemoria);
				
		if(args[1].equals("MD")){
			mapeamentoDireto(cache);
		}else if(args[1].equals("AC")){
			associativaPorConjunto(cache);
		}else{
			System.out.println("Argumento errado.");
		} 
		
	}
	
	public static void mapeamentoDireto(Cache cache) throws IOException{
		int numAcessos = 0;
		int numFalhas = 0;
		int numAcertos = 0;

		int bits = 0;
		boolean estado;
		int indice = 0;
		int expo = tamanhoMemoria/cache.tamanhoCache;
		while(expo > 1){	
			expo /= 2;
			bits++;
		}
			
		InputStream is = new FileInputStream("teste.txt");
		InputStreamReader isr = new InputStreamReader(is);
		BufferedReader br = new BufferedReader(isr);

		while (br.ready()) {

			String s = br.readLine();
			String[] linha = s.split("	");
			//System.out.println(linha[1]);
			//System.out.println(linha[1].substring(0,bits));
			//System.out.println(linha[1].substring(bits,9));
			//System.out.println(linha[1].substring(bits,10));
			if(cache.tamanhoBlocos == 1){
				indice = converteBinarioParaDecimal(linha[1].substring(bits,11));
			}else if(cache.tamanhoBlocos == 2){
				indice = converteBinarioParaDecimal(linha[1].substring(bits,10));
			}else if(cache.tamanhoBlocos == 4){
				indice = converteBinarioParaDecimal(linha[1].substring(bits,9));
			}
			int posicao = indice%(cache.tamanhoCache/cache.tamanhoBlocos);

			estado = cache.hitOrMiss(linha[1].substring(0, bits), posicao);
			if(estado){
				numAcertos++;
			}else{
				numFalhas++;
			}
			numAcessos++;				

		}
		
		System.out.println("Numero de acertos: "+numAcertos);
		System.out.println("Numero de falhas: "+numFalhas);
		System.out.println("Numero de acessos: "+numAcessos);		
	}

	public static void associativaPorConjunto(Cache cache) throws IOException{
		int numAcessos = 0;
		int numFalhas = 0;
		int numAcertos = 0;

		int blockOffset = 0;
		if(cache.tamanhoBlocos == 1){
			blockOffset = 0; 
		} else if(cache.tamanhoBlocos == 2){
			blockOffset = 1; 
		} else if(cache.tamanhoBlocos == 4){
			blockOffset = 2; 
		}
		
		int linhaOffset = 0;
		int expo = cache.tamanhoCache/cache.tamanhoBlocos;
		while(expo > 1){	
			expo /= 2;
			linhaOffset++;
		}		

		boolean estado;
		String indice = null;
		
		
		InputStream is = new FileInputStream("teste.txt");
		InputStreamReader isr = new InputStreamReader(is);
		BufferedReader br = new BufferedReader(isr);

		while (br.ready()) {

			String s = br.readLine();
			String[] linha = s.split("	");
			System.out.println(linha[1]);
			
			String tag = linha[1].substring(0,11-linhaOffset-blockOffset);
			indice = linha[1].substring(11-linhaOffset-blockOffset,11-blockOffset);
			System.out.println(indice);
			int valorIndice = converteBinarioParaDecimal(indice);
			int via = valorIndice%cache.numVias;

			estado = cache.hitOrMissAssociativa(indice, via, tag);
			if(estado){
				System.out.println("Acerto");
				numAcertos++;
			}else{
				System.out.println("Erro");
				numFalhas++;
			}
			numAcessos++;				
		}
		
		System.out.println("Numero de acertos: "+numAcertos);
		System.out.println("Numero de falhas: "+numFalhas);
		System.out.println("Numero de acessos: "+numAcessos);		
	}	
	
	public static int converteBinarioParaDecimal(String valorBinario) {
		   int valor = 0;
		 
		   // soma ao valor final o dígito binário da posição * 2 elevado ao contador da posição (começa em 0)
		   for (int i=valorBinario.length(); i>0; i--) {
		      valor += Integer.parseInt(valorBinario.charAt(i-1)+"")*Math.pow(2, (valorBinario.length()-i));
		   }
		 
		   return valor;
		}	
	
}
