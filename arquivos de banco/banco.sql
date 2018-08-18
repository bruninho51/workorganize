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

#PARA LIB DE FORMULÁRIOS DO SITE
CREATE TABLE campos(
	idCampo INTEGER AUTO_INCREMENT,
    label VARCHAR(50) NOT NULL,
    tipo VARCHAR(25) NOT NULL,
    opt TEXT,
    descricao TEXT NOT NULL,
    PRIMARY KEY(idCampo)
);
CREATE TABLE formularioMenu(
	idForm INTEGER NOT NULL,
    idMenu INTEGER NOT NULL,
    CONSTRAINT c_menu FOREIGN KEY(idMenu) REFERENCES menu(id),
    descricao TEXT
);
CREATE TABLE formulario(
	idFormulario INTEGER AUTO_INCREMENT,
    menu INTEGER NOT NULL,
    act VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    CONSTRAINT ct_menu FOREIGN KEY(menu) REFERENCES formularioMenu(idMenu),
    PRIMARY KEY(idFormulario)
);
CREATE TABLE camposFormulario(
	idFormulario INTEGER NOT NULL,
    idCampo INTEGER NOT NULL,
    CONSTRAINT ct_form FOREIGN KEY(idFormulario) REFERENCES formulario(idFormulario),
    CONSTRAINT c_campo FOREIGN KEY(idCampo) REFERENCES campos(idCampo),
    PRIMARY KEY(idFormulario, idCampo)
);