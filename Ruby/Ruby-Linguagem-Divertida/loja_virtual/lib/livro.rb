# encoding: utf-8
class Livro < Midia
	attr_writer  :isbn	# define o método set para a variável isbn
	attr_reader  :autor # define o método get para a variável autor
	attr_reader  :categoria 

	include FormatadorMoeda
	
	# Contrutor
	def initialize(titulo, autor, isbn = "1", numero_de_paginas, preco, categoria)
		super()
		@titulo = titulo
		@autor = autor
		@isbn = isbn
		@numero_de_paginas = numero_de_paginas
		@preco = preco
		@categoria = categoria
		@desconto = 0.15	#utilizada pela classe Midia
	end
	
	# Método que retorna uma mensagem sempre que o método "puts" é chamado para imprimir a variável
	def to_s
		puts "Título: #{@titulo}, Autor: #{@autor}, ISBN: #{@isbn}, Pág: #{@numero_de_paginas}, Cat: #{@categoria}"
	end
	
	#Método para comparação de livros, compara pelos seus números de ISBN
	def eql?(outro_livro)
		@isbn == outro_livro.isbn
	end
	
	# Em ruby as chaves das hashs são containers gerados para cada objeto. Dessa forma
	# para verificar se duas instâncias de um objeto são iguais, devemos indicar qual o atributo para a comparação
	# Neste caso o atributo escolhido foi o do valor isbn para comparar dois livros iguais.
	# Perceba que as instâncias não ocupam a mesma posição de memória.
	def hash
		@isbn.hash
	end
	
=begin
	# Definição manual dos métodos get e set para a variável preco
	# Método get para acessar o preço do livro
	def preco
		@preco
	end
	
	# Método set para alterar o valor do preço do livro
	# O sinal de "=" é uma convenção para o nome de métodos set, não é necessário
	def preco=(preco)
		@preco = preco
	end
=end
end