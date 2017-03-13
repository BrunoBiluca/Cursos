require "spec_helper"
require 'rspec/collection_matchers'
require "bag_of_words"

describe BagOfWords do
	it "its possible to put words on it" do
		bag = BagOfWords.new
		bag.put("hello", "world")
		# Podemos melhorar a expressividade do nosso teste trazendo o problema
		# mais próximo do nosso domínio. No caso testar se existe 2 palavras
		# na nossa bag, em vez de testar o tamanho do array words
		# expect(bag.words.size).to eq 2
		expect(bag).to have(2).words
	end

	it "the string in the bag accepts regex" do
		bag = BagOfWords.new
		bag.put("hello", "world")
		expect(bag.words[0]).to match(/hello/)
	end
	# Usando testes para verificar quando um erro acontece
	# No caso deste teste é levantada uma exceção de concatenação de tipos diferentes
	it "its go wrong if you put integer in the bag" do
		bag  = BagOfWords.new
		expect do
			bag.put(23 + "blah")
		end.to raise_error(TypeError)
	end

	it "The bag its a bag of words, so only strings please" do
		bag = BagOfWords.new
		bag.put(23)
		expect(bag.words[0]).to be_a_kind_of(String)
	end

	# Podemos verificar se houve alguma mudança de estado do objeto
	it "put words in the bag will fill up" do
		bag = BagOfWords.new
		expect {
			bag.put("Coisa")
		}.to change { bag.estado }.from("vazia").to("tem coisa")
	end
end