CREATE DATABASE CadeMeuMedicoBD
GO

USE CadeMeuMedicoBD
GO

CREATE TABLE Usuarios
(
	IDUsuario BIGINT IDENTITY(1,1) NOT NULL,
	Nome VARCHAR(80) NOT NULL,
	Login VARCHAR(30) NOT NULL,
	Senha VARCHAR(100) NOT NULL,
	Email VARCHAR(100) NOT NULL,

	PRIMARY KEY(IDUsuario)
);
GO

CREATE TABLE Medicos
(
	IDMedico BIGINT IDENTITY(1,1) NOT NULL,
	CRM VARCHAR(30) NOT NULL,
	Nome VARCHAR(80) NOT NULL,
	Endereco VARCHAR(100) NOT NULL,
	Bairro VARCHAR(60) NOT NULL,
	Email VARCHAR(100) NULL,
	AtendePorConvenio BIT NOT NULL,
	TemClinica BIT NOT NULL,
	WebsiteBlog VARCHAR(80) NULL,
	IDCidade INT NOT NULL,
    	IDEspecialidade INT NOT NULL,

	PRIMARY KEY(IDMedico)
);
GO

CREATE TABLE Especialidades
(
	IDEspecialidade INT IDENTITY(1,1) NOT NULL,
	Nome VARCHAR(80) NOT NULL,

	PRIMARY KEY(IDEspecialidade)
);
GO

CREATE TABLE Cidades
(
	IDCidade INT IDENTITY(1,1) NOT NULL,
	Nome VARCHAR(100) NOT NULL,

	PRIMARY KEY(IDCidade)
);
GO

ALTER TABLE Medicos
ADD CONSTRAINT fk_medicos_cidades
FOREIGN KEY(IDCidade)
REFERENCES Cidades(IDCidade)
GO

ALTER TABLE Medicos
ADD CONSTRAINT fk_medicos_especialidades
FOREIGN KEY(IDEspecialidade)
REFERENCES Especialidades(IDEspecialidade)
GO


INSERT INTO Cidades (Nome) VALUES ('Blumenau')
INSERT INTO Cidades (Nome) VALUES ('São José do Rio Preto')
GO

INSERT INTO Especialidades (Nome) VALUES ('Cardiologista')
INSERT INTO Especialidades (Nome) VALUES ('Neurologista')
GO

Insert Into Usuarios (Nome, Login, Senha, Email) Values ('Administrador', 'admin', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF','admin@cdmm.com')
