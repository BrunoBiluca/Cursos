#include<stdio.h>

int main(){
	
	int dia, dia_escolhido, mes, mes_escolhido, ano, ano_escolhido, diasemana, cont_domingos;
	
	dia = 1;
	mes = 1;
	ano = 1900;
	diasemana = 0;
	
	dia_escolhido = 31;
	mes_escolhido = 12;
	ano_escolhido = 2000;
	cont_domingos = 0;
	
	while((dia != dia_escolhido || mes != mes_escolhido) && ano != ano_escolhido){
		
		dia++;
		diasemana++;
		
		if(diasemana == 7 && dia == 1 && ano >= 1901){cont_domingos++;}
		
		if(diasemana == 7){
			diasemana = 0;
		}

		if((mes == 4 || mes == 6 || mes == 9 ||mes == 11) && dia == 30){
			dia = 0;
			mes++;
		} else if((mes == 1 || mes == 3 || mes == 5 ||mes == 7 ||mes == 8 ||mes == 10 ||mes == 12) && dia == 31){
			dia = 0;
			mes++;
		} else if((ano % 4 == 0 || ano != 1900) && (mes == 2 && dia == 29)){
			dia = 0;
			mes++;
		} else if((ano % 4 != 0 || ano == 1900) && (mes == 2 && dia == 28)){
			dia = 0;
			mes++;
		}
		
		if(mes > 12){
			ano++;
			mes=1;
		}
	}
	
	printf("%d\n", cont_domingos);

	return 0;
}
