require 'yaml'

class BancoDeArquivos
	def salva(livro)
		File.open("livros.yml", "a") do |arquivo|
			arquivo.puts YAML.dump(livro)
			arquivo.puts ""
		end
	end

	def carrega
		$/ = "\n\n"	# cofigura o separador de linhas do arquivos
		File.open("livros.yml", "r").map do |livro_serializado|	#map retorna um array
			YAML.load livro_serializado	#Lê o livro serializado do arquivo YML
		end
	end
	
end