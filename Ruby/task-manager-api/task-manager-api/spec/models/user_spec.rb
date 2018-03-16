require 'rails_helper'

RSpec.describe User, type: :model do
    let(:user) { build(:user) } 

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
end



