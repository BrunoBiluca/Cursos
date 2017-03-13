class User < ActiveRecord::Base
	scope :confirmed, -> {where('confirmed_at IS NOT NULL')}
	#attr_accessor :bio, :email, :full_name, :location, :password
	#Escopo de consulta ao banco de dados
	

	#Validações de presença, campos obrigatórios
	validates_presence_of :email, :full_name, :location

	#Necéssário passar um atributo virtual (atributo que não está no banco)
	#este atributo deve ser identico ao atributo selecionado no caso password
	#Só assim o objeto será salvo no banco
	#validates_confirmation_of :password

	validates_length_of :bio, :minimum => 30, :allow_blank => false

	#Validações do email
	validates_format_of :email, :with => /\A[^@]+@([^@\.]+\.)+[^@\.]+\z/
	validates_uniqueness_of :email

	has_secure_password

	before_create :generate_token
	def generate_token
		self.confirmation_token = SecureRandom.urlsafe_base64
	end

	def confirm!
		return if confirmed?

		self.confirmed_at = Time.current
		self.confirmation_token = ''
		save!
	end

	def confirmed?
		confirmed_at.present?
	end

	def self.authenticate(email, password)
		confirmed.find_by_email(email).try(:authenticate, password)
	end
end
