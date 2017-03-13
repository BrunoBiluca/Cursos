# Todo bloco de código em Ruby retorna algo

a = "0"
b = if (a == "0")
		1
	elsif(a == "1")
		"3"
	else
		2
	end
	
puts b

c = "13-09-1992"
case c
	when /\d{4}-\d{2}-\d{2}/
		puts "Formato yyyy-mm-dd"
	when /\d{2}-\d{2}-\d{4}/
		puts "Formato dd-mm-yyyy"
	when /\d{2}-\d{2}-\d{2}/
		puts "Formato yy-mm-dd"
	else
		puts "Não reconheco este formato"
	end
