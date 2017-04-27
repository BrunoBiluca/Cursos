
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
    class dbAcesso{
        private $dbHost = 'localhost'; // endereco do servidor de banco de dados
        private $dbUser = 'root'; // login do banco de dados
        private $dbPass = ''; // senha
        private $dbName = 'hospital'; // nome do banco de dados a ser usado
        public $conecta;
        
        public function conecta(){
            $this->conecta = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
            if (!$this->conecta) {
                die('Não foi possivel conectar: ' . mysql_error());
            }
            
            $seleciona = mysql_select_db($this->dbName, $this->conecta);
            if(!$seleciona){
                die('Não foi possivel selecionar o banco de dados: ' . mysql_error());
            }
        }
        
        //Cria o banco de dados
        public function criaDB(){
            $sqlCriaBanco = 'CREATE DATABASE IF NOT EXISTS ' . $this->dbName;
            if (mysql_query($sqlCriaBanco, $this->conecta)) {
                echo "O banco de dados hospital foi criado\n";
            } else {
                echo 'Erro criando o banco de dados: ' . mysql_error() . "\n";
            }
            
        }

        //Cria as tabelas
        public function criaTabelaUsuarios(){
//            $droparTabela = "DROP TABLE IF EXISTS Usuarios";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Usuarios("
                    . "login VARCHAR(20) NOT NULL,"
                    . "senha VARCHAR(20) NOT NULL,"
                    . "tipoUsuario CHAR(1) NOT NULL,"            //Determina tipo de usuario
                    . "PRIMARY KEY(login))";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Usuarios criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Usuários: " . mysql_error() . "\n";
            }
        }

        public function criaTabelaClientes(){
//            $droparTabela = "DROP TABLE IF EXISTS Clientes";
//            mysql_query($droparTabela,$this->conecta);
                        
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Clientes("
                    . "cpf CHAR(14) NOT NULL,"
                    . "nome VARCHAR(50) NOT NULL,"
                    . "idade INT,"
                    . "sexo CHAR(1),"
                    . "rua VARCHAR(50) NOT NULL,"
                    . "bairro VARCHAR(50) NOT NULL,"
                    . "cidade VARCHAR(50) NOT NULL,"
                    . "estado VARCHAR(2) NOT NULL,"
                    . "numero VARCHAR(5) NOT NULL,"
                    . "complemento VARCHAR(10),"
                    . "cep VARCHAR(9) NOT NULL,"
                    . "telefoneR VARCHAR(13),"
                    . "celular VARCHAR(13),"
                    . "telefoneC VARCHAR(13),"
                    . "login VARCHAR(20) NOT NULL,"     //Chave estrangeira da tabela de usuarios
                    //Fazer chave estrangeira para login
                    . "PRIMARY KEY(cpf),"
                    . "FOREIGN KEY(login) REFERENCES Usuarios(login) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Clientes criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Clientes: " . mysql_error() . "\n";
            }
        }

        public function criaTabelaMedicos(){
//            $droparTabela = "DROP TABLE IF EXISTS Medicos";
//            mysql_query($droparTabela,$this->conecta);            

            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Medicos("
                    . "cpf CHAR(14) NOT NULL,"
                    . "nome VARCHAR(50) NOT NULL,"
                    . "idade INT,"
                    . "sexo CHAR(1),"
                    . "rua VARCHAR(50) NOT NULL,"
                    . "bairro VARCHAR(50) NOT NULL,"
                    . "cidade VARCHAR(50) NOT NULL,"
                    . "estado VARCHAR(2) NOT NULL,"
                    . "numero VARCHAR(5) NOT NULL,"
                    . "complemento VARCHAR(10),"
                    . "cep VARCHAR(9) NOT NULL,"
                    . "telefoneR VARCHAR(13),"
                    . "celular VARCHAR(13),"
                    . "telefoneC VARCHAR(13),"
                    . "especialidade VARCHAR(20),"                  //Apenas para medicos
                    . "salario REAL,"
                    . "dataIngresso DATE NOT NULL,"
                    . "login VARCHAR(20) NOT NULL,"     //Chave estrangeira da tabela de usuarios
                    . "PRIMARY KEY(cpf),"
                    . "FOREIGN KEY(login) REFERENCES Usuarios(login) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Medicos criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Medicos: " . mysql_error() . "\n";
            }
        }

        public function criaTabelaEnfermeiros(){
//            $droparTabela = "DROP TABLE IF EXISTS Enfermeiros";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Enfermeiros("
                    . "cpf CHAR(14) NOT NULL,"
                    . "nome VARCHAR(50) NOT NULL,"
                    . "idade INT,"
                    . "sexo CHAR(1),"
                    . "rua VARCHAR(50) NOT NULL,"
                    . "bairro VARCHAR(50) NOT NULL,"
                    . "cidade VARCHAR(50) NOT NULL,"
                    . "estado VARCHAR(2) NOT NULL,"
                    . "numero VARCHAR(5) NOT NULL,"
                    . "complemento VARCHAR(10),"
                    . "cep VARCHAR(9) NOT NULL,"
                    . "telefoneR VARCHAR(13),"
                    . "celular VARCHAR(13),"
                    . "telefoneC VARCHAR(13),"
                    . "salario REAL,"
                    . "dataIngresso DATE NOT NULL,"
                    . "login VARCHAR(20) NOT NULL,"     //Chave estrangeira da tabela de usuarios                    
                    . "PRIMARY KEY(cpf),"
                    . "FOREIGN KEY(login) REFERENCES Usuarios(login) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Enfermeiros criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Enfermeiros: " . mysql_error() . "\n";
            }
        }

        public function criaTabelaGerentes(){
//            $droparTabela = "DROP TABLE IF EXISTS Gerentes";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Gerentes("
                    . "cpf CHAR(14) NOT NULL,"
                    . "nome VARCHAR(50) NOT NULL,"
                    . "idade INT,"
                    . "sexo CHAR(1),"
                    . "rua VARCHAR(50) NOT NULL,"
                    . "bairro VARCHAR(50) NOT NULL,"
                    . "cidade VARCHAR(50) NOT NULL,"
                    . "estado VARCHAR(2) NOT NULL,"
                    . "numero VARCHAR(5) NOT NULL,"
                    . "complemento VARCHAR(10),"
                    . "cep VARCHAR(9) NOT NULL,"
                    . "telefoneR VARCHAR(13),"
                    . "celular VARCHAR(13),"
                    . "telefoneC VARCHAR(13),"
                    . "salario REAL,"
                    . "dataIngresso DATE NOT NULL,"
                    . "login VARCHAR(20) NOT NULL,"     //Chave estrangeira da tabela de usuarios                    
                    . "PRIMARY KEY(cpf),"
                    . "FOREIGN KEY(login) REFERENCES Usuarios(login) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Gerentes criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Gerentes: " . mysql_error() . "\n";
            }
        }

        public function criaTabelaAdms(){
//            $droparTabela = "DROP TABLE IF EXISTS Administradores";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Administradores("
                    . "cpf CHAR(14) NOT NULL,"
                    . "nome VARCHAR(50) NOT NULL,"
                    . "idade INT,"
                    . "sexo CHAR(1),"
                    . "rua VARCHAR(50) NOT NULL,"
                    . "bairro VARCHAR(50) NOT NULL,"
                    . "cidade VARCHAR(50) NOT NULL,"
                    . "estado VARCHAR(2) NOT NULL,"
                    . "numero VARCHAR(5) NOT NULL,"
                    . "complemento VARCHAR(10),"
                    . "cep VARCHAR(9) NOT NULL,"
                    . "telefoneR VARCHAR(13),"
                    . "celular VARCHAR(13),"
                    . "telefoneC VARCHAR(13),"
                    . "salario REAL,"
                    . "dataIngresso DATE NOT NULL,"
                    . "login VARCHAR(20) NOT NULL,"     //Chave estrangeira da tabela de usuarios                    
                    . "PRIMARY KEY(cpf),"
                    . "FOREIGN KEY(login) REFERENCES Usuarios(login) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Administradores criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Administradores: " . mysql_error() . "\n";
            }
        }       
        
        public function criaTabelaConsultorios(){
//            $droparTabela = "DROP TABLE IF EXISTS Consultorios";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Consultorios("
                    . "patrimonio CHAR(11) NOT NULL,"
                    . "manutencao REAL NOT NULL,"
                    . "local VARCHAR(20) NOT NULL,"
                    . "PRIMARY KEY(patrimonio))";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Consultorios criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Usuários: " . mysql_error() . "\n";
            }
        }        

        public function criaTabelaLeitos(){
//            $droparTabela = "DROP TABLE IF EXISTS Leitos";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Leitos("
                    . "patrimonio CHAR(11) NOT NULL,"
                    . "manutencao REAL NOT NULL,"
                    . "tipo CHAR(7) NOT NULL,"
                    . "local VARCHAR(20) NOT NULL,"
                    . "PRIMARY KEY(patrimonio))";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Leitos criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Usuários: " . mysql_error() . "\n";
            }
        }        

        public function criaTabelaSalaCirurgia(){
//            $droparTabela = "DROP TABLE IF EXISTS SalaCirurgia";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS SalaCirurgia("
                    . "patrimonio CHAR(11) NOT NULL,"
                    . "manutencao REAL NOT NULL,"
                    . "tipo VARCHAR(20) NOT NULL,"
                    . "local VARCHAR(20) NOT NULL,"
                    . "PRIMARY KEY(patrimonio))";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Sala de cirurgia criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Usuários: " . mysql_error() . "\n";
            }
        }        
        
        public function criaTabelaAgendaMedico(){
//            $droparTabela = "DROP TABLE IF EXISTS AgendaMedico";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS AgendaMedico("
                    . "id INT NOT NULL AUTO_INCREMENT,"
                    . "login VARCHAR(20) NOT NULL,"
                    . "patrimonio CHAR(11) NOT NULL,"
                    . "dataInicio DATETIME NOT NULL,"
                    . "dataFim DATETIME NOT NULL,"
                    . "PRIMARY KEY(id),"
                    . "FOREIGN KEY(login) REFERENCES Medicos(login) ON DELETE CASCADE,"
                    . "FOREIGN KEY(patrimonio) REFERENCES Consultorios(patrimonio) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Agenda dos Médicos criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Agenda dos Médicos: " . mysql_error() . "\n";
            }
        }
        
        public function criaTabelaAgendaEnfermeiro(){
//            $droparTabela = "DROP TABLE IF EXISTS AgendaMedico";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS AgendaEnfermeiro("
                    . "id INT NOT NULL AUTO_INCREMENT,"
                    . "login VARCHAR(20) NOT NULL,"
                    . "dataInicio DATETIME NOT NULL,"
                    . "dataFim DATETIME NOT NULL,"
                    . "PRIMARY KEY(id),"
                    . "FOREIGN KEY(login) REFERENCES Enfermeiros(login) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela Agenda dos Enfermeiros criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela Agenda dos Enfermeiros: " . mysql_error() . "\n";
            }
        }
        
        public function criaTabelaConsultas(){
//            $droparTabela = "DROP TABLE IF EXISTS AgendaMedico";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Consultas("
                    . "id INT NOT NULL AUTO_INCREMENT,"
                    . "loginMedico VARCHAR(20) NOT NULL,"
                    . "loginCliente VARCHAR(20) NOT NULL,"
                    . "pConsultorio CHAR(11) NOT NULL,"
                    . "data DATETIME NOT NULL,"
                    . "PRIMARY KEY(id),"
                    . "FOREIGN KEY(loginMedico) REFERENCES AgendaMedico(login) ON DELETE CASCADE,"
                    . "FOREIGN KEY(pConsultorio) REFERENCES AgendaMedico(patrimonio) ON DELETE CASCADE,"
                    . "FOREIGN KEY(loginCliente) REFERENCES Clientes(login) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela de Consultas criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela de Consultas: " . mysql_error() . "\n";
            }
        }   

        public function criaTabelaCirurgias(){
//            $droparTabela = "DROP TABLE IF EXISTS AgendaMedico";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Cirurgias("
                    . "id INT NOT NULL AUTO_INCREMENT,"
                    . "loginMedico VARCHAR(20) NOT NULL,"
                    . "loginCliente VARCHAR(20) NOT NULL,"
                    . "loginEnfermeiro1 VARCHAR(20) NOT NULL,"
                    . "loginEnfermeiro2 VARCHAR(20),"
                    . "loginEnfermeiro3 VARCHAR(20),"
                    . "pSala CHAR(11) NOT NULL,"
                    . "dataInicio DATETIME NOT NULL,"
                    . "dataFim DATETIME NOT NULL,"
                    . "descricao VARCHAR(140) NOT NULL,"
                    . "PRIMARY KEY(id),"
                    . "FOREIGN KEY(loginMedico) REFERENCES AgendaMedico(login) ON DELETE CASCADE,"
                    . "FOREIGN KEY(loginEnfermeiro1) REFERENCES Enfermeiros(login) ON DELETE CASCADE,"
                    . "FOREIGN KEY(pSala) REFERENCES SalaCirurgia(patrimonio) ON DELETE CASCADE,"
                    . "FOREIGN KEY(loginCliente) REFERENCES Clientes(login) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela de Cirurgia criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela de Cirurgia: " . mysql_error() . "\n";
            }
        }  
        
        public function criaTabelaRecuperacao(){
//            $droparTabela = "DROP TABLE IF EXISTS AgendaMedico";
//            mysql_query($droparTabela,$this->conecta);
            
            $sqlCriaTabela = "CREATE TABLE IF NOT EXISTS Recuperacao("
                    . "id INT NOT NULL AUTO_INCREMENT,"
                    . "loginMedico VARCHAR(20) NOT NULL,"
                    . "loginCliente VARCHAR(20) NOT NULL,"
                    . "loginEnfermeiro VARCHAR(20) NOT NULL,"
                    . "pLeito CHAR(11) NOT NULL,"
                    . "descricao VARCHAR(140) NOT NULL,"
                    . "PRIMARY KEY(id),"
                    . "UNIQUE(loginCliente),"
                    . "FOREIGN KEY(loginMedico) REFERENCES AgendaMedico(login) ON DELETE CASCADE,"
                    . "FOREIGN KEY(loginEnfermeiro) REFERENCES Enfermeiros(login) ON DELETE CASCADE,"
                    . "FOREIGN KEY(pLeito) REFERENCES Leitos(patrimonio) ON DELETE CASCADE,"
                    . "FOREIGN KEY(loginCliente) REFERENCES Clientes(login) ON DELETE CASCADE)";
            if (mysql_query($sqlCriaTabela,$this->conecta)) {
              echo "Tabela de Recuperação criada com sucesso\n";
            } else {
              echo "Erro na criação da tabela de Recuperação: " . mysql_error() . "\n";
            }
        }          
        public function droparTabela($tabela){
            $droparTabela = "DROP TABLE IF EXISTS $tabela";
            mysql_query($droparTabela,$this->conecta);
        }
        
        public function desconecta(){
            mysql_close($this->conecta);
        }
    }
?>
        </body>
</html>