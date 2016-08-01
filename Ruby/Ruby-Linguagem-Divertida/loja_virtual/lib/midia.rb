class Midia
	# Atributos que se repetem em todos as classes que tem um comportamento de mídia
	attr_accessor :preco # define os métodos get e set para a variável preco
	attr_reader :titulo
	
	def initialize
		@desconto = 0.1
	end
	
	def preco_com_desconto
		@preco - (@preco * @desconto)
	end
	
end