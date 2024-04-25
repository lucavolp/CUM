DROP DATABASE 5cvolpinari_milizia;
CREATE DATABASE 5cvolpinari_milizia;
USE 5cvolpinari_milizia;

CREATE TABLE Ruolo(
    id INTEGER PRIMARY KEY,
    ruolo VARCHAR(20) NOT NULL,
    descrizione VARCHAR(200)
);

CREATE TABLE Grado(
    id INTEGER PRIMARY KEY,
    grado VARCHAR(50) NOT NULL,
    data_graduazione DATE,
    descrizione VARCHAR(200)
);

CREATE TABLE Utente(
    usr VARCHAR(25) PRIMARY KEY,
    pwd VARCHAR(30) NOT NULL,
    nome VARCHAR(30) NOT NULL,
    cognome VARCHAR(30) NOT NULL,
    data_arruolo DATE,
    data_nascita DATE NOT NULL,
    PA BOOLEAN,
    cellulare VARCHAR(16) NOT NULL,
);
-- inserire FK per id_ruolo ed id_grado

CREATE TABLE Servizio(
    nome TEXT PRIMARY KEY,
    min_persone INTEGER,
    ore_durata INTEGER,
    luogo TEXT,
    gettone INTEGER NOT NULL
);

CREATE TABLE Comunicazione(
    cod INTEGER PRIMARY KEY AUTO_INCREMENT,
    oggetto VARCHAR(40),
    contenuto VARCHAR(10000),
    destinatari VARCHAR(1000)
);

CREATE TABLE Assenza(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    data DATE,
    dettagli VARCHAR(200),
);
-- inserire FK per utente_username ed id_tipologia