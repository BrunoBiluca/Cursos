# encoding: utf-8

Quando /^começo um novo jogo$/ do
	#game = Game.new
	#game.start
	# Alteração para utilizar a Gem Aruba
	# O Aruba simula as interações dos usuários, facilitando os testes de aceitação
	# Steps é uma função do Aruba, entre os steps definitions do Aruba
	# Utilizo o arquivo .bat na pasta bin para forçar o programa a rodar e ver o comportamento
	# steps %{
	# 	When I run `forca.bat` interactively
	# }
	start_new_game
end

Então /^o jogo termina com a seguinte mensagem na tela:$/ do |text|
	steps %Q{
		Then it should pass with:
		"""
		#{text}
		"""
	}
end

Dado(/^que comecei um jogo$/) do
  start_new_game
end

Quando(/^escolho que a palavra a ser sorteada deverá ter "([^"]*)" letras$/) do |number_of_letters|
  steps %{
  	When I type "#{number_of_letters}"
  }
end