module GameHelpers
	def start_new_game
		steps %{
			When I run `forca.bat` interactively
		}
	end
end
World(GameHelpers)