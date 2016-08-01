# encoding: utf-8
require 'yaml'
require "FileUtils"

class Revista
	attr_reader :titulo, :id
	attr_accessor :preco
	
	def initialize(titulo, preco)
		@titulo = titulo
		@preco = preco
		@id = self.class.next_id
		@destroyed = false
		@new_record = true
	end

	# Create Update
	def save
		@new_record = false
	
		File.open("db/revistas/#{@id}.yml", "w") do |file|
			file.puts serialize
		end
	end
	
	# Find
	def self.find(id)
		# raise interrompe a execução do método
		# caller retorna a Stack Trace para indicar mais organizadamente o que aconteceu
		raise DocumentNotFound, "Arquivo db/revistas/#{id} não encontrado.", caller unless File.exists?("db/revistas/#{id}.yml")
		YAML.load File.open("db/revistas/#{id}.yml", "r")
	end
	
	#Delete
	def destroy
		unless @destroyed or @new_record
			@destroyed = true
			FileUtils.rm "db/revistas/#{@id}.yml"
		end
	end
	
	private
	
	def serialize
		YAML.dump self
	end
	
	def self.next_id
		Dir.glob("db/revistas/*.yml").size + 1
	end
	
end