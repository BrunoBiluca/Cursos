Given(/^a turtle$/) do
  puts "turtle!"
end
Given(/^two turtles$/) do
  steps %{
    Given a turtle
    And a turtle
  }
  puts "turtle!"
end

Given(/^start the game$/) do
	steps %{
		When I run `forca.bat` interactively
	}
end

Then(/^the game shows the follow message:$/) do |string|
	steps %Q{
		Then it should pass with:
		"""
		#{string}
		"""
	}
end