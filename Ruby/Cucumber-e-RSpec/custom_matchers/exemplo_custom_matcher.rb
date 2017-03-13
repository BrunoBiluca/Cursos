RSpec::Matchers.define :be_a_multiple_of do |expected|
	match do |actual|
		(actual % expected) == 0
	end
end

describe "The be_a_multiple_of custom matcher" do
	it "can be used to verify if a number is a multiple of another one" do
		expect(21).to be_a_multiple_of(7)
		expect(15).to be_a_multiple_of(3)
		expect(9).to be_a_multiple_of(3)
	end
end