require 'rails_helper'

RSpec.describe User, type: :model do
    let(:user) { build(:user) } 
    let(:token) { 'abc123xyzTOKEN' }
    let(:token_2) { 'abc123xyzTOKEN2' }

    # subject { build(:user) }
    # before { @user = FactoryBot.build(:user) }

    # it { expect(@user).to respond_to :email }
    # it { expect(@user).to respond_to :name }
    # it { expect(@user).to respond_to :password }
    # it { expect(@user).to respond_to :password_confirmation }
    # it { expect(@user).to be_valid }

    # it { is_expected.to respond_to :email }
    # it { is_expected.to respond_to :password }
    # # it { is_expected.to respond_to :name }
    # it { is_expected.to respond_to :password_confirmation }
    # it { is_expected.to be_valid }
    
    it { is_expected.to validate_presence_of(:email) }
    it { is_expected.to validate_uniqueness_of(:email).case_insensitive }
    it {is_expected.to validate_confirmation_of :password }
    it { is_expected.to validate_uniqueness_of :auth_token }

    describe '#info' do
        it "returns email, created_at and token information" do
            user.save!
            # Forma de utilizar um Mock em um método
            allow(Devise).to receive(:friendly_token).and_return(token) 

            expect(user.info).to eq "#{user.email} - #{user.created_at} - TOKEN: #{token}"
        end
        
    end

    describe '#generate_authentication_token!' do
        it 'generates a unique auth token' do
            allow(Devise).to receive(:friendly_token).and_return(token)
            user.generate_authentication_token!
            expect(user.auth_token).to eq(token)
        end
        
        it 'generates another auth token when the current auth token already has been taken' do
            allow(Devise).to receive(:friendly_token).and_return(token, token, token_2)
            existing_user = create(:user)
            user.generate_authentication_token!

            expect(user.auth_token).not_to eq(existing_user.auth_token)
        end
    end

end



