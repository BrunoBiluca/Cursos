require 'api_version_constraint'

Rails.application.routes.draw do

  # devise_for :users

  namespace :api, defaults: {format: :json}, constraints: {subdomain: 'api'}, path: "/" do
    namespace :v1, path: "/", constraints: ApiVersionConstraint.new(version: 1, defaults: true) do
      resources :users, only: [:show, :create, :update, :destroy]
    end
  end

end
