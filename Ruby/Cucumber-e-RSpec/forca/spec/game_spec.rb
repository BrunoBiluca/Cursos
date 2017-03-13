# encoding: utf-8

require 'spec_helper'
require 'game'

describe Game do
	describe "#start" do
		it "prints the initial message" do
			game = Game.new

			initial_message = "Bem vindo ao jogo da forca!\n"
			expect {game.start}.to output(initial_message).to_stdout
		end
	end	
end