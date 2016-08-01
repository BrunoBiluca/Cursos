# encoding: UTF-8

require File.expand_path("lib/livro")
require File.expand_path("lib/biblioteca")

teste_e_design = Livro.new("Mauricio Aniche", "123454", 247, 59.90)
web_design_responsivo = Livro.new("Tárcio Zemel", "452565", 321, 79.90)

puts teste_e_design
puts web_design_responsivo

puts teste_e_design.preco

# teste_e_design.preco=(13.87) # versão padrão
# Como colocamos o sinal de = podemos escrever essa linha de código de uma forma mais elegante
teste_e_design.preco = 13.87 # forma elegante

puts teste_e_design.preco

puts teste_e_design.autor

puts teste_e_design.isbn = 12321
puts teste_e_design

bib = Biblioteca.new
bib.adiciona(teste_e_design)
p bib

teste_e_design.isbn = 666
p bib