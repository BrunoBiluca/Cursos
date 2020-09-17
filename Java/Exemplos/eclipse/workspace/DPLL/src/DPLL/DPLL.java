/************************************************************************
 * 	ALgoritmo DPLL
 * 
 * 	Autores: Bruno Bernardes da costa
 * 			 Jonas Gabriel
 * 			 Michael Douglas de Campos
 * 
 * Para a execução:
 * 			Deve-se utilizar o programa Eclipse para a visualização apropriada 
 * 		do código (ou outro visualizador de algoritmos);
 *			 
 *		Abrindo o Eclipse crie um novo projeto vá em File/Import e selecione General e depois Archive File
 *		Mova o arquivo para o Packpage DPLL.
 * 		Vá em Run/Run Configurations... e Selecione a aba Arguments
 * 		entre com sua expressaõ lógica em Program Arguments e clique em run;
 * 		Na vanela Console será exibido o resultado.
 * 
 * Conectivos Aceitos:
 * 		Negação: ~
 * 		Conjunção: ^
 * 		Disjunção: v
 * ->Não são aceitos espaços entre os conectivos e as proposições
 * 
 * 	Entrada: Fórmula na FNC
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
		
		
		//Separação dos literais
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
		
	//Realiza a ordenação inversa dos literais com relação ao número de ocorrências
		Collections.sort(literais);
		
		System.out.println(dpll(formula));
	}
	
	
	//Função que chama e verifica através da função de propagação se a fórmula é satisfatível 
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
	
//Função que realiza a propagação dos literais existentes na formula
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
			//remove da fórmula todas as cláusulas que contém Unitaria
			//Clausula unitária negada
			naoUnitaria = "~"+unitaria;
			
		//Elimina caso existam duas ou mais negações na cláusula 
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
			
			//remover a negações
			for(int i=0;i<lista.size();i++){	
				//Cria o array com todas as variáveis da cláusula
				ArrayList<Literal> variaveis = new ArrayList<Literal>();
				for(String elem:lista.get(i).palavra.split("v")){
					elem = elem.replace("(", "");
					elem = elem.replace(")", "");
					Literal e = new Literal();
					e.palavra = elem;
					variaveis.add(e);
				}
				//Remove todas as ocorrencias das unitárias negadas
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
				
				//Junta todas as variáveis da cláusula que não foram eliminadas
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
		//Monta a string que contém a fórmula que será retornada
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
	
//verifica se existe cláusula unitária na fórmula 
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
	
	//Retorna a cláusula unitária
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
