CREATE DATABASE workorganize;
USE workorganize;
CREATE TABLE tipoPerfil(
    id INTEGER AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    descricao TEXT,
    PRIMARY KEY(id)
    
);
CREATE TABLE usuario(
    usuario VARCHAR(30),
    senha VARCHAR(50) NOT NULL,
    ativo BOOLEAN NOT NULL,
    tipoPerfil INTEGER NOT NULL,
    PRIMARY KEY(usuario),
    FOREIGN KEY(tipoPerfil) REFERENCES tipoPerfil(id)
);
CREATE TABLE trabalho(
    id INTEGER AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    dataInicio DATE NOT NULL,
    dataFim DATE NOT NULL,
    dataTermino DATE,
    realizado INTEGER NOT NULL,
    idUsuario VARCHAR(30) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idUsuario) REFERENCES usuario(usuario)
);
CREATE TABLE anotacaoTrabalho(
    id INTEGER AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL,
    corpo TEXT NOT NULL,
    idTrabalho INTEGER NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idTrabalho) REFERENCES trabalho(id)
);
CREATE TABLE anexoTrabalho(
    id INTEGER NOT NULL,
    arqLoc TEXT NOT NULL,
    mime VARCHAR(20) NOT NULL,
    idTrabalho INTEGER NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idTrabalho) REFERENCES trabalho(id)
);
CREATE TABLE anexoAnotacao(
    id INTEGER NOT NULL,
    idAnotacaoTrabalho INTEGER NOT NULL,
    ArqLoc TEXT NOT NULL,
    mime VARCHAR(20) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idAnotacaoTrabalho) REFERENCES anotacaoTrabalho(id)
    
);
CREATE TABLE modulo(
	id INTEGER AUTO_INCREMENT NOT NULL,
    modulo VARCHAR(100) NOT NULL,
    act VARCHAR(100),
    descricao TEXT NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE tipoPerfilModulo(
	id INTEGER AUTO_INCREMENT NOT NULL,
    idTipoPerfil INTEGER NOT NULL,
    idModulo INTEGER NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT tipoPerfil FOREIGN KEY(idTipoPerfil) REFERENCES tipoPerfil(id),
    CONSTRAINT modulo FOREIGN KEY(idModulo) REFERENCES modulo(id)
);

CREATE TABLE menu(
	id INTEGER AUTO_INCREMENT NOT NULL,
    idModulo INTEGER NOT NULL,
    idMenuPai INTEGER NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    ativo INTEGER NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT ctModulo FOREIGN KEY(idModulo) REFERENCES modulo(id)
);