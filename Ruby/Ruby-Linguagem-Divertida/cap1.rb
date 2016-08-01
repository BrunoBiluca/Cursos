# Ruby é uma linguagem fortemente tipada
valor = 10
mult = "2"
#puts valor * mult #Esta operação retorna erro

# Ruby é uma linguagem de tipagem dinâmica
idade = 23
idade = "23"
puts idade		#Tipo da idade foi alterado de FixNum para String

def plural(palavra)
	"#{palavra}s"
end

puts plural("caneta")
puts plural("vaso")

=begin
	Podemos fazer a função plural ser um comportamento do objeto String
	Dessa forma temos uma arquitetura orientada a objetos
	Este recurso é chamado de classes abertas(OpenClasses).
=end
class String
	def plural
		"#{self}s"
	end
end
puts "caneta".plural