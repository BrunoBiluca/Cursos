class Stack
	def initialize
		@elements = []
	end
	
	def push element
		@elements << element 
	end
	
	def pop
		@elements.pop
	end
	
	def top
		# -1 na posição do array é a última posição
		@elements[-1]
	end
end

# Teste que descreve o comportamento da classe Stack
# Red - Green - Refactore
# Faz o teste passar e depois refatora para melhorar o desing do código
describe Stack do
	# Teste que descreve o comportamento do método Push
	describe "#push" do
		it "puts a element at the top of the stack" do
			stack = Stack.new

			stack.push 1
			stack.push 2

			expect(stack.top).to eq 2
		end
	end
	describe "#pop" do
		it "pop the element at the top of the stack" do
			stack = Stack.new

			stack.push 1
			stack.push 2
			stack.pop

			expect(stack.top).to eq 1
		end
	end

end