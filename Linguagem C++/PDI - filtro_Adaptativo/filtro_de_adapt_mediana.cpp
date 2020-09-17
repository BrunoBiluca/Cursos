#include<stdio.h>
#include<math.h>
#include<algorithm>
#include "CImg.h"
using namespace cimg_library;

int main(int argc,char **argv) {


	CImg<int>					imagein(argv[1]),
							imageout(imagein.width(),imagein.height(),1,1);
	
	int tamanho = 3;
	int result=tamanho*tamanho;
	int A1, zMed, zMin, zMax;
	int A2;
	int B1;
	int B2;
	int tamanhoMax=7;
	
	int x,y,a,b,elementos;
	
	bool acabou = false;
	
	
		for(x=0;x<imagein.width();x++){
			for(y=0;y<imagein.height();y++){
				acabou=false;
				while(!acabou){
				int mediana[result];
				elementos=0;
				for(a=-(tamanho)/2;a<=(tamanho)/2;a++){
					for(b=-(tamanho)/2;b<=(tamanho)/2;b++){
						if ((x+a>=0) && (x+a<imagein.width() && (y+b>=0) && (y+b<imagein.height()))){
							mediana[elementos]=imagein.atXY(x-a,y-b);						
							elementos++;
						}
					}
				}
				std::sort(mediana,mediana+(result));
				
				zMed = mediana[result/2];
				zMin = mediana[0];
				zMax = mediana [result-1];
				
				
				A1= zMed - zMin;
				A2= zMed - zMax;
				
			if (A1>0 && A2<0) {
				B1 = imagein.atXY(x,y) - zMin;
				B2 = imagein.atXY(x,y) - zMax;
				if (B1>0 && B2<0) {
					imageout.atXY(x,y)=imagein.atXY(x,y);
					acabou=true;
				}else{
					imageout.atXY(x,y)=zMed;
					acabou=true;
					}
				 
				}else{
					if (tamanho<tamanhoMax){
						tamanho+=2;
						result=tamanho*tamanho;				
					}else{
						imageout.atXY(x,y)=zMed;
					    acabou=true;
					}
					
				}
			}
		}
	}
		imageout.save_png("Result.png");

}
