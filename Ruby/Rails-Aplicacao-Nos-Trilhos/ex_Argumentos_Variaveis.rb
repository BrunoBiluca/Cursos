def sum (*values)
	puts values.inspect
	values.reduce { |sum, value| sum + value}
end

# O primeiro argumento está destacado dos demais
def sum2 (first, *values)
	puts values.inspect
	values.reduce(first) { |sum, value| sum + value}
end

puts sum(1, 2, 3)
puts sum2(1, 2, 3)