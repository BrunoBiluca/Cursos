class UserSession
	include ActiveModel::Validations
	include ActiveModel::Conversion

	extend ActiveModel::Naming
	extend ActiveModel::Translation

	attr_accessor :email, :password

	validates_presence_of :email, :password

	#Construtor
	def initialize(session, attributes={})
		@session = session
		@email = attributes[:email]
		@password = attributes[:password]
	end

	#Método responsável por fazer a autenticação do objeto
	def authenticate
		user = User.authenticate(@email, @password)
		if user.present?
			store(user)
		else
			errors.add(:base, :invalid_login)
			false
		end
	end

	#Método responsável por salvar o session no cookie
	def store(user)
		@session[:user_id] = user.id
	end

	#Necessário implementar quando se inclui no modelo o ActiveModel conversion
	def persisted?
		false
	end
end