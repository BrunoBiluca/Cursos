# Forma de reaproveitar os testes para classes que tem comportamentos parecidos
# É definido para estas classes uma interface ou classe abstrata, no caso do Ruby module
# Este módulo pode ser testado para todas as classes definindo o tipo de comportamento de cada
module Publishable
	attr_reader :published_on

	def publish!
		today = Time.now.strftime("%Y-%m-%d")
		@published_on = today
	end
end

# Define um comportamento que a classe BlogPost terá
class BlogPost
	include Publishable
end

class Paper
	include Publishable
end

# O shared_examples_for deve vir no código antes dos métodos describe
# Ruby é interpretada afinal de contas e esse tipo de coisa é obtido em RunTime
shared_examples_for "a publishable object" do
	describe "#pushish" do
		it "saves the date  when the object is published" do
			subject.publish!

			today = Time.now.strftime("%Y-%m-%d")
			expect(subject.published_on).to eq(today)
		end
	end
end

describe BlogPost do
	it_behaves_like "a publishable object"
end

describe Paper do
	it_behaves_like "a publishable object"
end



