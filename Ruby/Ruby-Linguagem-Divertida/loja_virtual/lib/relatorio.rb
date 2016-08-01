class Relatorio
	def initialize(biblioteca)
		@biblioteca = biblioteca
	end

	# Forma mais habitual de fazer o método total
	#def total
	#	soma = 0.0
	#	@biblioteca.livros.each do |livro|
	#		soma += livro.preco
	#	end
	#	soma # return
	#end
	
	# Método total utilizando inject
	def total
		@biblioteca.livros.inject(0){
			|tot, livro|	# Argumentos, tot, argumento acumulador, livro argumento da iteração
			tot += livro.preco
		}
	end
	
	# Forma mais habitual de fazer o método que busca os títulos dos livros da biblioteca
	#def titulos
	#	titulos = []
	#	@biblioteca.livros.each do |livro|
	#		titulos << livro.titulo
	#	end
	#	titulos
	#end
	
	# Retorna um vetor com todos os títulos da biblioteca utilizando map
	def titulos
		@biblioteca.livros.map {
			|livro|
			livro.titulo
		}
		
		#@biblioteca.livros.map &:titulo #gera o mesmo código que a versão de cima
	end
	
end