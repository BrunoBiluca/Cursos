#Strings
nome_completo = "Bruno Costa"
github = "/BrunoBiluca"

nome_com_aspas = "Joana d'Arc" #funciona
#nome = 'Joana d'Arc' #não unciona

string_especial = %{Isso e "normal" e 'util' no mundo Ruby e a partir de agora veremos a {todo} momento}
puts string_especial

#Concatenação 2 formas
nome = "Bruno"
boas_vindas = "Seja bem-vindo(a) " + nome
boas_vindas = "Seja bem-vindo(a) #{nome}"	#Interpolação
puts boas_vindas

#Condicional
idade = 23
if idade > 18
	puts nome
end

puts nome if idade > 18		#Forma mais enxuta

#VAlor nil
puts "Welcome #{nome}" unless nome.nil? #if not nome.nil? - unless = if not
puts "Welcome 2 #{nome}" if nome		#O valor nil assume um valor bool dentro de um if - true existe - false - não existe 
nome = nil
puts "Nome nao encontrado" if nome.nil?

#REpetição
n = 3
for numero in (1..n)
	puts "Numero: #{numero}"
end

numero = 1
while numero <= n
	puts "Numero: #{numero}"
	numero += 1
end

numero = 1
until numero == (n+1)
	puts "Numero: #{numero}"
	numero += 1	
end