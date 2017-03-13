Rails.application.routes.draw do
	LOCALES = /en|pt\-BR/

	scope ":locale", :locale => LOCALES do
	  resources :rooms
	  resources :users

	  resources :user_sessions, :only => [:create, :new, :destroy]
	end
	resource :user_confirmations, :only => [:show]
	get '/:locale' => 'home#index', :locale => LOCALES
	root :to => "home#index" 
end
