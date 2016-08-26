#encoding: utf-8

# Exemplos de Arrays e strings
a = %w{a b c d e f}
p a

a = [1, 2, 3]
b = [3, 4, 5]
# União
p a + b # [1, 2, 3, 3, 4, 5]

# União - elementos repetidos
p a | b # [1, 2, 3, 4, 5] - Na união, elementos duplicados são removidos

# Interseção
p a & b # [3] - Na interseção, apenas os repetidos ficam

p [1,2,3].reverse

# Concatena com o parâmetro
p ["laranja", "banana"].join(" e ")

p a.pop			# retira o último elemento do array
p a.shift		# retira o primeiro elemento do array
p a