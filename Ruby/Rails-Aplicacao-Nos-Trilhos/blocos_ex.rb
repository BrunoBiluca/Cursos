File.open('file.txt', 'w') do |file|
	file.puts "Escrevendo no arquivo utlizando blocos do Ruby!"
end

#Passando vários argumentos para o blocos
a = {:a => 1, :b => 2, :c => 3}

a.each do |key, value|
	puts "A chave #{key} possui o valor #{value}"
end