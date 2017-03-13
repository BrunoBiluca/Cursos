class BagOfWords
	attr_reader :words
	attr_reader :estado

	def initialize
		@words = []
		@estado = "vazia"
	end

	def put *words
		@estado = "tem coisa"
		words.each do |word|
			@words << word.to_s	
		end
	end
end