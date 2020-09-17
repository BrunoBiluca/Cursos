#include <stdio.h>
#include "CImg.h"
using namespace cimg_library;

//****************************Variaveis Globais****************************************

	int fundo = 0;
	int objeto = 255;
	int tamanho = 3;

//****************************Binariazar imagem*****************************************


void limiarizacao(CImg<int>* binaria,CImg<int> entrada){
	
	for(int x=0;x<binaria->width();x++){
		for(int y=0;y<binaria->height();y++){
			if(entrada.atXY(x,y)<205){
				binaria->atXY(x,y) = fundo;
			}else{
				binaria->atXY(x,y) = objeto;
			}
		}
	}						
	
}

//****************************EROSÂO****************************************************

void erosao(CImg<int>* imageout,CImg<int> binaria){
	int tamanho = 5;
	for(int x=1;x<binaria.width()-1;x++){
		for(int y=1;y<binaria.height()-1;y++){
			int numPontos = 0;
			for(int a=-(tamanho/2);a<=(tamanho/2);a++){
				for(int b=-(tamanho/2);b<=(tamanho/2);b++){
					if(binaria.atXY(x+a,y+b) == objeto){
						numPontos++;
					}
				}
			}
			if(numPontos == 25){
				imageout->atXY(x,y) = objeto;
			}		
		}
	}
	
}

//*****************************DILATAÇÂO*************************************************

void dilatacao(CImg<int>* imageout,CImg<int> binaria, int** elementoEstruturante){
	for(int x=1;x<binaria.width()-1;x++){
		for(int y=1;y<binaria.height()-1;y++){
			if(binaria.atXY(x,y) == objeto){
				for(int a=-(tamanho/2);a<=(tamanho/2);a++){
					for(int b=-(tamanho/2);b<=(tamanho/2);b++){
						if(elementoEstruturante[a+tamanho/2][b+tamanho/2] == objeto){
							imageout->atXY(x+a,y+b) = objeto*binaria.atXY(x+a,y+b)/255;
						}
					}
				}	
			}	
		}
	}
	
}

//*****************************Componente Conexo*************************************************

void componentesConexo(CImg<int> imagem, int** elementoEstruturante){
	CImg<int>	atual(imagem.width(),imagem.height(),1,1,fundo),
				anterior(imagem.width(),imagem.height(),1,1,fundo);
	
	int* componente = (int*) malloc(imagem.height()*imagem.width()*sizeof(int));
	memset(componente,0,imagem.height()*imagem.width()*sizeof(int));
	bool achei = true;
	int quantObj = 0;
	
	while(achei){
		achei = false;
		for(int x=0;x<imagem.width();x++){
			for(int y=0;y<imagem.height();y++){
				if(imagem.atXY(x,y) == objeto){
					//printf("achei");
					atual.atXY(x,y) = objeto;
					achei = true;
					break;
				}
			}	
			if(achei) break;
		}
		if(achei){
			while(atual != anterior){
				anterior = atual;
				dilatacao(&atual,imagem,elementoEstruturante);
			}
			int cont = 0;
			for(int x=0;x<imagem.width();x++){
				for(int y=0;y<imagem.height();y++){
					if(atual.atXY(x,y) == objeto){
						cont++;
					}
				}
			}
			componente[quantObj++] = cont;
			imagem = imagem - atual;			
		}
	}
	int i=0;
	while(componente[i]!=0){
		printf("Componente %d = %d de tamanho\n",i,componente[i]);
		i++;
	}
	
}


int main(int argc, char** argv){
	
	int** elementoEstruturante = (int**) malloc(tamanho*sizeof(int*));
	for(int i=0;i<tamanho;i++){
		elementoEstruturante[i] = (int*) malloc(tamanho*sizeof(int));
	}
	
	//Elemento Estruturante
								
	elementoEstruturante[0][0] = objeto;		elementoEstruturante[0][1] = objeto;	elementoEstruturante[0][2] = objeto;
	elementoEstruturante[1][0] = objeto;		elementoEstruturante[1][1] = objeto;	elementoEstruturante[1][2] = objeto;
	elementoEstruturante[2][0] = objeto;		elementoEstruturante[2][1] = objeto;	elementoEstruturante[2][2] = objeto;


	CImg<int>	imagein(argv[1]),
				erodida(imagein.width(),imagein.height(),1,1,fundo),
				imageout(imagein.width(),imagein.height(),1,1,fundo);
							
	CImg<int> binaria(imagein.width(),imagein.height(),1,1,fundo);
	
	limiarizacao(&binaria,imagein);

	//Erosao

	erosao(&erodida,binaria);

	erodida.save_png("Erodida.png");

	componentesConexo(erodida, elementoEstruturante);	

	return 0;
}

