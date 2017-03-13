class Room < ActiveRecord::Base
	#attr_accessor :descption, :location, :title
	def complete_name
		"#{title}, #{location}"
	end
end
