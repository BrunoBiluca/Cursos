package Lista2;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;

class Palavra{
	public String palavra;
	public int contador = 1;
}

public class Exercicio3 {

	public static void main(String[] args) throws IOException{
		ArrayList<Palavra> lista = new ArrayList<Palavra>();
		try{		

		InputStream is = new FileInputStream(args[0]);
		InputStreamReader isr = new InputStreamReader(is);
		BufferedReader br = new BufferedReader(isr);
		
		String s = br.readLine();

		while (s != null) {
			for(String elem:s.split(" ")){
				int flag = 0;
				for(int i=0;i<lista.size();i++){
					if(elem.equals(lista.get(i).palavra)){ 
						lista.get(i).contador++;
						flag = 1;
					}
				}
			if(flag == 0){
				Palavra e = new Palavra();
				e.palavra = elem;
				lista.add(e);
			}
			}
			s = br.readLine();
		}	
			br.close();	
		}catch(FileNotFoundException excessao){
			System.out.println("File Not Found");
		}
		for(Palavra item:lista){
			System.out.println(item.palavra+" "+item.contador);
		}
	}
}
