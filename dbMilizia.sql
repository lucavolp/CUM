    DROP DATABASE 5cvolpinari_milizia;
    CREATE DATABASE 5cvolpinari_milizia;
    USE 5cvolpinari_milizia;

    CREATE TABLE Ruolo(
        id INTEGER PRIMARY KEY,
        ruolo VARCHAR(20) NOT NULL,
        descrizione VARCHAR(200)
    );

    CREATE TABLE Grado(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        grado VARCHAR(50) NOT NULL,
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
        mail VARCHAR(64),
        FOREIGN KEY (id_ruolo) REFERENCES Ruolo(id),
        FOREIGN KEY (id_grado) REFERENCES Grado(id)
    );

    CREATE TABLE Servizio(
        nome VARCHAR(30) PRIMARY KEY,
        min_persone INTEGER,
        ore_durata INTEGER,
        luogo VARCHAR(50),
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
        utente_usr VARCHAR(25),
        id_tipologia INTEGER,
        FOREIGN KEY (utente_usr) REFERENCES Utente(usr),
        FOREIGN KEY (id_tipologia) REFERENCES Tipologia(id)
    );

    CREATE TABLE Festivita(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(35),
        data DATE,
        descrizione VARCHAR(500),
        num_mese INTEGER NULL
    );

    DELIMITER //
    CREATE TRIGGER setNumMesi
    BEFORE INSERT ON Festivita
    FOR EACH ROW
    BEGIN
        SET NEW.num_mesi = MONTH(NEW.data);
    END;
    // 
    DELIMITER ;
    ;

    INSERT INTO `Utente` (`usr`, `pwd`, `nome`, `cognome`, `data_arruolo`, `data_nascita`, `PA`, `cellulare`, `id_ruolo`, `id_grado`) VALUES ('admin', '2yn.4fvaTgedM', 'admin', 'admin', NULL, '2005-05-21', 0, '3669886162', NULL, NULL);
    INSERT INTO `Festivita` (`id`, `nome`, `data`, `descrizione`) VALUES (NULL, "Sant'Agata", '2024-02-05', 'Compatrona'), (NULL, "Festa dell'arengo e Milizie", '2024-03-25', "Festa dell'arengo e delle Milizie"), (NULL, "Insediamento Reggenti", '2024-04-01', 'Insediamento nuovi capitani reggenti'), (NULL, "Insediamento Reggenti2", '2024-04-02', 'Insediamento nuovi capitani reggenti');
    INSERT INTO `Servizio` (`nome`,`min_persone`, `ore_durata`, `luogo`, `gettone`) VALUES ('Manovra',2,1,'Citta',15);
    -- ALTER TABLE Grado DROP COLUMN data_graduazione;
    INSERT INTO `Grado` (`grado`, `descrizione`) VALUES ('Capitano','Comandante del Corpo'), ('Tenente','Ufficiale subalterno'), ('Sotto-Tenente','Ufficiale Subalterno'), ('Sergente Maggiore', 'Sottufficiale'), ('Caporal Maggiore', 'Graduato'), ('Caporale', 'Graduato'), ('Milite', 'Milite');
    alter table Utente add mail varchar(64);
    -- UPDATE Utente SET pwd = '2yn.4fvaTgedM' WHERE usr = 'admin';
    INSERT INTO `Ruolo` (`ruolo`, `descrizione`) VALUES ('admin', 'amministratore con accesso completo'), ('user', 'utente con accesso limitato');