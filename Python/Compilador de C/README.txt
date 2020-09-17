******************************************************************************
				README
******************************************************************************

O analisador semântico foi desenvolvido para a disciplina de Compiladores no curso
de Ciência da Computação da Universidade Federal de São João del Rei.

autores: Bruno Bernardes da Costa
		 Maine Santos Lima

data : 10/12/2014

Propósito: 

	O objetivo deste trabalho é implementar um analisador semântico para o
	analisador léxico e sintático implementados anteriormente. O analisador semântico
	utiliza como entrada o arquivo de um código sintaticamente correto, gerado pelo analisador léxico
	e então é retornado o cógido assembly referente aquele código.

Como compilar: 
	É necessário ter em seu computador o interpretador da linguagem Python 
	versão 2.0 ou mais.
	No terminal de comando o comando para executar o programa é:
	python analisadorSintatico.py -c <nome_arquivo.txt>

		
Descrição do código e tabela de símbolos:
	Basicamente foram criadas funções cujos nomes tem prefixo "gera", e escrevem 
	no arquivo quadradupla gerando assim o código intermediário em assembly. 
	Essas funções são chamadas em lugares específicos do código, e realizam 
	o processo com o auxílio de quatro pilhas. Não foi implementada a análise
	semântica neste trabalho, apenas a geração de código intermediário.
