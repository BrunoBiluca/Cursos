require 'rails_helper'

RSpec.describe 'User API', type: :request do
    let!(:user) { create(:user) }
    let(:user_id) { user.id }
    let(:headers) do
        {
            'Accept': 'application/vnd.taskmanager.v1',
            'Content-Type': Mime[:json].to_s
        }
    end
    
    before { host! 'api.task-manager.test' }

    describe 'Get users/:id' do
        before do
            get "/users/#{user_id}", params: {}, headers: headers
        end

        context 'when user exists' do

            it 'returns the user' do
                expect(json_body[:id]).to eq user_id
            end
            
            it 'returns status 200' do
                expect(response).to have_http_status(200)
            end
            
        end

        context 'when user not exists' do
            let(:user_id) { -1 }
            it 'returns status 404' do
                expect(response).to have_http_status(404)
            end
        end
    end 
    
    describe 'POST /users' do

        before do
            post '/users', params: {user: user_params}.to_json, headers: headers
        end
        

        context 'when the json params are valid' do
            let(:user_params) {attributes_for(:user)}
            it 'returns http code 201' do
                expect(response).to have_http_status(201)
            end

            it 'returns json data form created user' do
                expect(json_body[:email]).to eq user_params[:email]
            end
            
        end

        context 'when the json params are invalid' do
            let(:user_params) {attributes_for(:user, email:'invalid@')}

            it 'returns http code 422' do
                expect(response).to have_http_status 422
            end

            it 'returns json data for the errors' do
                expect(json_body).to have_key :errors
            end
        end
      
    end
    
    describe 'PUT /users/:id' do
        before do
            put "/users/#{user_id}", params: {user: user_params}.to_json, headers: headers
        end

        context "when the json params are valid" do
            let(:user_params) { {email: "new.valid.email@taskmanager.com"} }

            it "returns http code 200" do
                expect(response).to have_http_status 200 
            end                

            it "returns a json with updated user" do
                expect(json_body[:email]).to eq(user_params[:email])
            end
            
        end
        
        context "when the json params are invalid" do
            let(:user_params) { {email: "new.invalid.email@"} }

            it "returns http code 422" do
                expect(response).to have_http_status 422 
            end                

            it "returns a json with updated user" do
                expect(json_body).to have_key :errors
            end
            
        end
    end

    describe "DELETE /users/:id" do
        before do
            delete "/users/#{user_id}", params: {}, headers: headers
        end

        context "when the user exists" do
            it "returns http code 204" do
                expect(response).to have_http_status 204 
            end
            
            it "cannot find user after exclusion" do
                expect(User.find_by(id: user.id)).to be_nil
            end
            
        end
        
    end
    

end
