class Biblioteca
	attr_reader :livros
	
	include Enumerable

	def initialize
		# @livros = [] # Inicializa com um Array
		# @livros = {} # Inicializa com um Hash
		#Inicia o banco de arquivos
		@banco_de_arquivos = BancoDeArquivos.new
	end

=begin # Nota��o normal
	def adiciona(livro)
		# @livros << livro # Adiciona a �ltima posi��o do Array
		@livros[livro.categoria] ||= [] # Verifica se a posi��o est� vazia, se estiver cria, se n�o n�o faz nada
		@livros[livro.categoria] << livro		
		@banco_de_arquivos.salva livro
	end
=end	
	
	#Utilizando a nota��o por blocos
	def adiciona(midia)
		salva midia do
			midias << midia						# chama o m�todo midias
		end
	end
	
	def midias
		@midias ||= @banco_de_arquivos.carrega	# os objetos s�o buscados apenas na primeira vez que a vari�vel � usada
	end
	
	# Retorma um array com os livros de uma determinada categoria
	# � necess�rio passar um bloco de c�digo como argumento
=begin	# Utilizando pesquisa no Hash
	def livros_por_categoria(categoria)
		@livros[categoria].each do |livro| 	# vari�vel livro � a vari�vel para cada itera��o
			yield livro if block_given?		# executa um bloco que � passado na chamada do m�todo
											# dessa forma o que ser� feito com o array que for retornado ser� de responsabilidade da chamada do m�todo
											# O m�todo block_given? verifica se um bloco foi passado como argumento
		end
	end
=end	

	# Utilizando Array
	# Retorna um array de livros determinados pela categoria
	def midias_por_categoria(categoria)
		midias.select do |midia| 
			midia.categoria == categoria if midia.respond_to? :categoria	# Objetos que possuem o atributo categoria
		end
	end
	
	def each
		midias.each { |midia| yield midia }
	end

	private	#M�todo privado, todos os m�tdos abaixo s�o considerados privados
	
	def salva(midia)
		@banco_de_arquivos.salva midia
		yield
	end
	
end