#encoding: UTF-8

require File.expand_path("loja_virtual")

biblioteca = Biblioteca.new
teste_e_design = Livro.new "Teste e design", "Mauricio Aniche", "123454", 247, 69.9, :testes
web_design_responsivo = Livro.new "Web design responsivo", "Tárcio Zemel", "452565", 189, 69.9, :web_design
biblioteca.adiciona teste_e_design
biblioteca.adiciona web_design_responsivo
relatorio = Relatorio.new biblioteca
p relatorio.total
p relatorio.titulos