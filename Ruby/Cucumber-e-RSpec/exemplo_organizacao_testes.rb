class Game
	attr_accessor :phase
	attr_reader :output
	attr_reader :score

	def player_hits_target
		@output = "Congratulations!"
		@score = 100
	end
end

describe Game, "in final phase" do
	context "when the player hits the target" do
		# Podemos extrair as configurações que são iguais entre os testes
		# Before é um método do expect que executa antes do expect
		# Existem também o Around e o After
		before do
			@game = Game.new
			@game.phase = :final
		end

		it "congratulates the player" do
			@game.player_hits_target
			expect(@game.output).to eq("Congratulations!")
		end

		it "sets the score to 100" do
			@game.player_hits_target
			expect(@game.score).to eq(100)
		end		
	end
end