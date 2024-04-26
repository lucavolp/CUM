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
    id_ruolo INTEGER,
    id_grado INTEGER,
    FOREIGN KEY (id_ruolo) REFERENCES Ruolo(id),
    FOREIGN KEY (id_grado) REFERENCES Grado(id)
);

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

CREATE TABLE Tipologia(
    id INTEGER PRIMARY KEY,
    tipo VARCHAR(40),
    descrizione VARCHAR(250)
);

CREATE TABLE Assenza(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    data DATE,
    dettagli VARCHAR(200),
    FOREIGN KEY (utente_usr) REFERENCES Utente(usr),
    FOREIGN KEY (id_tipologia) REFERENCES Tipologia(id)
);



INSERT INTO `Utente` (`usr`, `pwd`, `nome`, `cognome`, `data_arruolo`, `data_nascita`, `PA`, `cellulare`, `id_ruolo`, `id_grado`) VALUES ('admin', 'admin', 'admin', 'admin', NULL, '2005-05-21', BIN('0'), '3669886162', NULL, NULL);