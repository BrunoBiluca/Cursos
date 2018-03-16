RUBY_VERSION="2.5.0"
RAILS_VERSION="5.1.5"
MYSQL_PASSWORD="123456"
GIT_USER_NAME="BrunoBiluca"
GIT_USER_EMAIL="b.b.da.costa@gmail.com"
NODE_VERSION="9.8.0"



echo
echo "========================================================================"
echo "# ATUALIZANDO O SISTEMA OPERACIONAL"
echo "========================================================================"
sudo apt-get update && sudo apt-get upgrade -y



echo
echo "========================================================================"
echo "# INSTALANDO E CONFIGURANDO O GIT"
echo "========================================================================"
sudo add-apt-repository ppa:git-core/ppa -y
sudo apt-get update
sudo apt-get install git -y
git config --global user.name "${GIT_USER_NAME}"
git config --global user.email "${GIT_USER_EMAIL}"



echo
echo "========================================================================"
echo "# INSTALANDO DEPENDENCIAS DO RVM/RUBY"
echo "========================================================================"
sudo apt-get install -y git-core curl zlib1g-dev build-essential libssl-dev libreadline-dev libyaml-dev \
                        libsqlite3-dev sqlite3 libxml2-dev libcurl4-openssl-dev python-software-properties \
                        libffi-dev nodejs libgdbm-dev libncurses5-dev automake libtool bison libxslt1-dev



echo
echo "======================================================================="
echo "# INSTALANDO E CONFIGURANDO O RVM"
echo "========================================================================"
gpg --keyserver hkp://keys.gnupg.net --recv-keys 409B6B1796C275462A1703113804BB82D39DC0E3
\curl -sSL https://get.rvm.io | bash -s stable
source ~/.rvm/scripts/rvm
rvm requirements



echo
echo "========================================================================"
echo "# INSTALANDO E CONFIGURANDO O RUBY NA VERSAO: ${RUBY_VERSION}"
echo "========================================================================"
rvm install ${RUBY_VERSION}
rvm use ${RUBY_VERSION} --default
touch ~/.gemrc
echo 'gem: --no-rdoc --no-ri' >> ~/.gemrc



echo
echo "========================================================================"
echo "# INSTALANDO E CONFIGURANDO O RAILS NA VERSAO: ${RAILS_VERSION}"
echo "========================================================================"
\curl -sSL https://deb.nodesource.com/setup_${NODE_VERSION}.x | sudo -E bash -
sudo apt-get update
sudo apt-get install nodejs -y
gem install rails -v ${RAILS_VERSION}



echo
echo "========================================================================"
echo "# INSTALANDO E CONFIGURANDO O MYSQL"
echo "========================================================================"
sudo apt-get install debconf-utils -y
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password ${MYSQL_PASSWORD}"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password ${MYSQL_PASSWORD}"
sudo apt-get install mysql-server mysql-client libmysqlclient-dev -y



echo
echo "========================================================================"
echo "# INSTALANDO E CONFIGURANDO O OH-MY-ZSH"
echo "========================================================================"
sudo apt-get update
sudo apt-get install zsh -y
echo "# setup zsh" >> .profile
echo "export SHELL=/bin/zsh" >> .profile
echo "[ -z "$ZSH_VERSION" ] && exec /bin/zsh -l" >> .profile
git clone git://github.com/robbyrussell/oh-my-zsh.git ~/.oh-my-zsh
cp ~/.oh-my-zsh/templates/zshrc.zsh-template ~/.zshrc