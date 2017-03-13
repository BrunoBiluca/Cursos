class UsersController < ApplicationController
	def new
		@user = User.new
	end

	def show
		@user = User.find(params[:id])
	end

	def create
		@user = User.new(user_params)
		if @user.save
			SignupMailer.confirm_email(@user).deliver_now
			redirect_to @user, :notice => 'Cadastro criado com sucesso!'
		else
			render :new
		end
	end

	def edit
		@user = User.find(params[:id])
	end

	def update
		@user = User.find(params[:id])
		if(@user.update_attributes(user_params))
			redirect_to @user, :notice => 'Cadastro atualizado com sucesso!'
		else
			render :edit
		end
	end

  	private

	def user_params
		params.require(:user).permit(:full_name, :email, :password, :password_confirmation, :location, :bio)		
	end
end