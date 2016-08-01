#coding: utf-8
class DVD < Midia
	
	include FormatadorMoeda
	
	def initialize(titulo, preco, categoria)
		super()	# Invoca o mesmo método da classe mãe
		@titulo = titulo
		@preco = preco
		@categoria = categoria
	end

	def to_s
		%Q{Título: #{@titulo}, Preço: #{@valor} }
	end
	
end