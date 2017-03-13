class HomeController < ApplicationController
	def index
		@rooms = Room.limit(3)
	end
end