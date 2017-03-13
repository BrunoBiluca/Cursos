def calc_parcelas (total_valor, quant_parcelas)
	begin
		puts "O resultado é #{total_valor/quant_parcelas}"
	rescue ZeroDivisionError
		puts "A quantidade de parcelas não pode ser 0 (zero)"
	rescue
		puts "Oops, aconteceu um erro"
	ensure
		puts "Este bloco é sempre executado"
	end
end

calc_parcelas 1000, 1000

calc_parcelas 1000, 0

calc_parcelas 1000, "d"
