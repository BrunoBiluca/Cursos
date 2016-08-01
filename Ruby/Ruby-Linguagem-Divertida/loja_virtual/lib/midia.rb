class Midia
	# Atributos que se repetem em todos as classes que tem um comportamento de m�dia
	attr_accessor :preco # define os m�todos get e set para a vari�vel preco
	attr_reader :titulo
	
	def initialize
		@desconto = 0.1
	end
	
	def preco_com_desconto
		@preco - (@preco * @desconto)
	end
	
end