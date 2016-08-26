#encoding: utf-8

# Exemplos de Hashes

# Inicialização
a = Hash.new
a["hello"] = 12
a["world"] = 13
a[1] = "hi"

p a

b = {"hello" => 12, "world" => 13, 1 => "h1"}
p b

# Inicialização usando símbolos
c = {hello: 12, world: 13}
p c

p a.keys

p a.values