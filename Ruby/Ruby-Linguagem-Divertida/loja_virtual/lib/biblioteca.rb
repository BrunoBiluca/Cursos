class Biblioteca
	attr_reader :livros
	
	include Enumerable

	def initialize
		# @livros = [] # Inicializa com um Array
		# @livros = {} # Inicializa com um Hash
		#Inicia o banco de arquivos
		@banco_de_arquivos = BancoDeArquivos.new
	end

=begin # Notação normal
	def adiciona(livro)
		# @livros << livro # Adiciona a última posição do Array
		@livros[livro.categoria] ||= [] # Verifica se a posição está vazia, se estiver cria, se não não faz nada
		@livros[livro.categoria] << livro		
		@banco_de_arquivos.salva livro
	end
=end	
	
	#Utilizando a notação por blocos
	def adiciona(midia)
		salva midia do
			midias << midia						# chama o método midias
		end
	end
	
	def midias
		@midias ||= @banco_de_arquivos.carrega	# os objetos são buscados apenas na primeira vez que a variável é usada
	end
	
	# Retorma um array com os livros de uma determinada categoria
	# É necessário passar um bloco de código como argumento
=begin	# Utilizando pesquisa no Hash
	def livros_por_categoria(categoria)
		@livros[categoria].each do |livro| 	# variável livro é a variável para cada iteração
			yield livro if block_given?		# executa um bloco que é passado na chamada do método
											# dessa forma o que será feito com o array que for retornado será de responsabilidade da chamada do método
											# O método block_given? verifica se um bloco foi passado como argumento
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

	private	#Método privado, todos os métdos abaixo são considerados privados
	
	def salva(midia)
		@banco_de_arquivos.salva midia
		yield
	end
	
end