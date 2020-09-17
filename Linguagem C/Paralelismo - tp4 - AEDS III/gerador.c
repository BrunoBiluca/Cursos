#include <stdlib.h>
#include <stdio.h>

int main (void)
{
	FILE *arq;
	int i,j,v;
	char nome[15];
	int NUM,opcao;
	
		
	srand(time(NULL));
	
	arq = fopen("entrada.txt","w");

	opcao = 1;
	NUM = 5000;
	
	//fprintf(arq,"%d\n",NUM);
	for (i=0;i<NUM;i++)
	{
		for (j=0;j<NUM;j++)
		{
			if (opcao == 1)
				v=rand()%2;
			else if (opcao == 2)
			{	if (j==1 && i!=NUM-1)
					v = 0;
				else
					v = 1;
			}
			else if (opcao == 3)
			{	if (j%2==1 && i!=NUM-1)
					v = 0;
				else
					v = 1;
			}
			
			fprintf(arq,"%d",v);
			if (j<NUM-1)
				fprintf(arq," ");
		}
		fprintf(arq,"\n");
	}
	fclose(arq);
	return 0;
}
