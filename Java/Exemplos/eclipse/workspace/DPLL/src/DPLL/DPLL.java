/************************************************************************
 * 	ALgoritmo DPLL
 * 
 * 	Autores: Bruno Bernardes da costa
 * 			 Jonas Gabriel
 * 			 Michael Douglas de Campos
 * 
 * Para a execu��o:
 * 			Deve-se utilizar o programa Eclipse para a visualiza��o apropriada 
 * 		do c�digo (ou outro visualizador de algoritmos);
 *			 
 *		Abrindo o Eclipse crie um novo projeto v� em File/Import e selecione General e depois Archive File
 *		Mova o arquivo para o Packpage DPLL.
 * 		V� em Run/Run Configurations... e Selecione a aba Arguments
 * 		entre com sua expressa� l�gica em Program Arguments e clique em run;
 * 		Na vanela Console ser� exibido o resultado.
 * 
 * Conectivos Aceitos:
 * 		Nega��o: ~
 * 		Conjun��o: ^
 * 		Disjun��o: v
 * ->N�o s�o aceitos espa�os entre os conectivos e as proposi��es
 * 
 * 	Entrada: F�rmula na FNC
 * 		exemplo: x1^(x2^x3)~x4
 * 
 * 
 * 
 * 
 ************************************************************************/


package DPLL;

import java.util.ArrayList;
import java.util.Collections;

class Clausula{
	public String palavra;	
}

class Literal implements Comparable<Literal>{
	public String palavra;
	public int contador;
	
	
	public int compareTo(Literal outro) {
		if (this.contador > outro.contador) {
			return -1;
			}
			if (this.contador < outro.contador) {
			return 1;
			}
			return 0;
	}	
}


public class DPLL{
	
	public static String formulaCompleta;
	public static ArrayList<Literal> literais = new ArrayList<Literal>();
	public static int contador = -1;

	public static void main(String[] args) {		
		
		String formula = args[0];		//Formula a ser simplificada
		formulaCompleta = args[0];		//Formula total
		
		
		//Separa��o dos literais
		for(String elem:formulaCompleta.split("\\^")){ 
			for(String elem2:elem.split("v")){
				int flag = 0;
				for(int i=0;i<literais.size();i++){
					if(elem2.equals(literais.get(i).palavra)){ 
						flag = 1;
						literais.get(i).contador++;
					}
				}
				if(flag == 0){
					if(elem2.contains("(") || elem2.contains(")")){
						elem2 = elem2.replace("(", "");
						elem2 = elem2.replace(")", "");
					}
					Literal e = new Literal();
					e.palavra = elem2;
					literais.add(e);
					literais.get(literais.size()-1).contador++;
				}
			}
		}
		
	//Realiza a ordena��o inversa dos literais com rela��o ao n�mero de ocorr�ncias
		Collections.sort(literais);
		
		System.out.println(dpll(formula));
	}
	
	
	//Fun��o que chama e verifica atrav�s da fun��o de propaga��o se a f�rmula � satisfat�vel 
	public static boolean dpll(String formula){
		
		formula = propague(formula);
		if(formula.equals("true")){
			return true;
		}
		else if(formula.equals("false")){
			return false;
		}
		
		
		
		//Resolver DPLL para os literais
		contador++;
		formula = formula+"^"+literais.get(contador).palavra;
		if(dpll(formula)){
			return true;
		}
		else{
			formula = formula+"^"+"~"+literais.get(contador).palavra;	
			return dpll(formula);
		}
	}
	
//Fun��o que realiza a propaga��o dos literais existentes na formula
	public static String propague(String formula){
		ArrayList<Clausula> lista = new ArrayList<Clausula>();
		String unitaria, naoUnitaria;
		
		for(String elem:formula.split("\\^")){
			Clausula e = new Clausula();
			e.palavra = elem;
			lista.add(e);
		}
		
		while(existeUnitaria(lista)){
			unitaria = clausulaUnitaria(lista);
			//remove da f�rmula todas as cl�usulas que cont�m Unitaria
			//Clausula unit�ria negada
			naoUnitaria = "~"+unitaria;
			
		//Elimina caso existam duas ou mais nega��es na cl�usula 
			if(naoUnitaria.substring(0,2).equals("~~")){
				naoUnitaria = naoUnitaria.substring(2,unitaria.length()+1);
			}

			int cont = 0;
			while(cont<lista.size()){
				int flag = 0;
				for(String elem:lista.get(cont).palavra.split("v")){
					elem = elem.replace("(", "");
					elem = elem.replace(")", "");
					if(elem.equals(unitaria)){
						lista.remove(cont);
						flag = 1;
						break;
					}
				}
				if(flag == 0){
					cont++;
				}
			}	
			if(lista.size() == 0){
				formula = "true";
			}
			
			//remover a nega��es
			for(int i=0;i<lista.size();i++){	
				//Cria o array com todas as vari�veis da cl�usula
				ArrayList<Literal> variaveis = new ArrayList<Literal>();
				for(String elem:lista.get(i).palavra.split("v")){
					elem = elem.replace("(", "");
					elem = elem.replace(")", "");
					Literal e = new Literal();
					e.palavra = elem;
					variaveis.add(e);
				}
				//Remove todas as ocorrencias das unit�rias negadas
				int cont2 = 0;
				while(cont2<variaveis.size()){
					int flag = 0;
					if(variaveis.get(cont2).palavra.equals(naoUnitaria)){
						variaveis.remove(cont2);
						flag = 1;
					}			
					if(flag == 0){
						cont2++;
					}
				}
				
				//Junta todas as vari�veis da cl�usula que n�o foram eliminadas
				lista.get(i).palavra = "";
				for(int j=0;j<variaveis.size();j++){
					lista.get(i).palavra += variaveis.get(j).palavra;
					if(j<(variaveis.size()-1)){
						lista.get(i).palavra = lista.get(i).palavra+"v";
					}
				}
				if(lista.get(i).palavra.equals("")){
					formula = "false";
				}		
			}
		}
		//Monta a string que cont�m a f�rmula que ser� retornada
		if(!formula.equals("true") && !formula.equals("false")){
			formula = "";
			for(int i=0;i<lista.size();i++){
				formula = formula+lista.get(i).palavra;
				if(i<(lista.size()-1)){
					formula = formula+"^";
				}
			}
		}
		return formula;
	}
	
//verifica se existe cl�usula unit�ria na f�rmula 
	public static boolean existeUnitaria(ArrayList<Clausula> lista){
		boolean retorno = false;
		for(int i=0;i<lista.size();i++){
			int cont = 0;
			for(int j = 0;j<lista.get(i).palavra.length();j++){
				if(lista.get(i).palavra.charAt(j) == 'x'){
					cont++;
				}
			}
			if(cont == 1){
				retorno = true;
				break;
			}
		}
		return retorno;
	}
	
	//Retorna a cl�usula unit�ria
	public static String clausulaUnitaria(ArrayList<Clausula> lista){
		String retorno = null;
		for(int i=0;i<lista.size();i++){
			int cont = 0;
			for(int j = 0;j<lista.get(i).palavra.length();j++){
				if(lista.get(i).palavra.charAt(j) == 'x'){
					cont++;
				}
			}
			if(cont == 1){
				retorno = lista.get(i).palavra;
				break;
			}
		}
		if(retorno.contains("(") || retorno.contains(")")){
			retorno = retorno.replace("(", "");
			retorno = retorno.replace(")", "");
		}
		return retorno;
	}	

}
