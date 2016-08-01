# encoding: utf-8
class Revista
	
	# A variável id pertence a classe não a instância
	# Cria um método singleton class do objeto Class que representa as definições da classe Revista
	# As variáveis id da classe e das instâncias estão em contextos diferentes, assim são diferentes
	@id = 0
	class << self
		def id
			@id += 1
		end
	end

	def initialize(titulo, preco)
		@id = self.class.id		# id da instância recebe o id corrente da class
		@titulo = titulo
		@preco = preco
	end

	# Método get titulo
	def titulo
		@titulo
	end
	
	# Método get id
	def id
		@id
	end
	
	def titulo_formatado
		"Título: #{ titulo }" 
	end
	
end