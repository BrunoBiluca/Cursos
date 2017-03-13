describe Array, "with some elements" do
	# O subject deixa explícito o objeto que é manipulado nos testes
	# Neste caso o objeto manipulado é o array
	subject(:array){[1,2,3]}

	it "shold have the prescribed elements" do
		expect(array).to eq([1,2,3])
	end
	
end

# Let serve para definir um método auxiliar para o teste.
# O Let tem comportamento de execução Lazy, assim ele só executa se for chamado
describe "The Lazy-evaluated behavior of let" do
	before {@foo = 'bar'}
	let(:broken_operation){raise "I'm Broken"}

	# Teste que espera como resposta uma exception
	it "will call the method defined by let" do
		expect{
			expect(@foo).to eq('bar')
			broken_operation
		}.to raise_error("I'm Broken")
	end

	it "won't call the method defined by let" do
		expect{
			expect(@foo).to eq("bar")
		}.not_to raise_error
	end	
end