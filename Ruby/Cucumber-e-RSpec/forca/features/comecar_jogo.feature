# encoding: utf-8
Feature: Start Game
	To play while passing time
	As a player
	I want to start a new game
	
  Scenario: Run command
    Given start the game
    Then the game shows the follow message:
		"""
		Bem vindo ao jogo da forca!
		"""