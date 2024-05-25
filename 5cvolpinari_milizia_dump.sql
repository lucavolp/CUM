-- MariaDB dump 10.19  Distrib 10.5.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 10.25.0.14    Database: 5cvolpinari_milizia
-- ------------------------------------------------------
-- Server version	10.5.19-MariaDB-0+deb11u2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Assenza`
--

DROP TABLE IF EXISTS `Assenza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Assenza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `dettagli` varchar(200) DEFAULT NULL,
  `utente_usr` varchar(25) DEFAULT NULL,
  `id_tipologia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utente_usr` (`utente_usr`),
  KEY `id_tipologia` (`id_tipologia`),
  CONSTRAINT `Assenza_ibfk_1` FOREIGN KEY (`utente_usr`) REFERENCES `Utente` (`usr`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Assenza`
--

LOCK TABLES `Assenza` WRITE;
/*!40000 ALTER TABLE `Assenza` DISABLE KEYS */;
INSERT INTO `Assenza` VALUES (1,'2024-05-21','Giustificata','luca',NULL);
/*!40000 ALTER TABLE `Assenza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comunicazione`
--

DROP TABLE IF EXISTS `Comunicazione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comunicazione` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `oggetto` varchar(40) DEFAULT NULL,
  `contenuto` varchar(10000) DEFAULT NULL,
  `destinatari` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comunicazione`
--

LOCK TABLES `Comunicazione` WRITE;
/*!40000 ALTER TABLE `Comunicazione` DISABLE KEYS */;
/*!40000 ALTER TABLE `Comunicazione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Festivita`
--

DROP TABLE IF EXISTS `Festivita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Festivita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `descrizione` varchar(500) DEFAULT NULL,
  `num_mese` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Festivita`
--

LOCK TABLES `Festivita` WRITE;
/*!40000 ALTER TABLE `Festivita` DISABLE KEYS */;
INSERT INTO `Festivita` VALUES (1,'Sant\'Agata','2024-02-05','Compatrona',2),(2,'Festa dell\'arengo e Milizie','2024-03-25','Festa dell\'arengo e delle Milizie',3),(3,'Insediamento Reggenti','2024-04-01','Insediamento nuovi capitani reggenti',4),(4,'Insediamento Reggenti2','2024-04-02','Insediamento nuovi capitani reggenti',4);
/*!40000 ALTER TABLE `Festivita` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`5cvolpinari`@`%`*/ /*!50003 TRIGGER setNumMesi     BEFORE INSERT ON Festivita     FOR EACH ROW     BEGIN         SET NEW.num_mese = MONTH(NEW.data);     END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Grado`
--

DROP TABLE IF EXISTS `Grado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Grado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grado` varchar(50) NOT NULL,
  `descrizione` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Grado`
--

LOCK TABLES `Grado` WRITE;
/*!40000 ALTER TABLE `Grado` DISABLE KEYS */;
INSERT INTO `Grado` VALUES (1,'Capitano','Comandante del Corpo'),(2,'Tenente','Ufficiale subalterno'),(3,'Sotto-Tenente','Ufficiale Subalterno'),(4,'Sergente Maggiore','Sottufficiale'),(5,'Caporal Maggiore','Graduato'),(6,'Caporale','Graduato'),(7,'Milite','Milite');
/*!40000 ALTER TABLE `Grado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ruolo`
--

DROP TABLE IF EXISTS `Ruolo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ruolo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruolo` varchar(20) NOT NULL,
  `descrizione` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ruolo`
--

LOCK TABLES `Ruolo` WRITE;
/*!40000 ALTER TABLE `Ruolo` DISABLE KEYS */;
INSERT INTO `Ruolo` VALUES (1,'admin','Amministratore con controllo totale'),(2,'user','utente con accesso normale');
/*!40000 ALTER TABLE `Ruolo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Servizio`
--

DROP TABLE IF EXISTS `Servizio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Servizio` (
  `nome` varchar(30) NOT NULL,
  `min_persone` int(11) DEFAULT NULL,
  `ore_durata` int(11) DEFAULT NULL,
  `luogo` varchar(50) DEFAULT NULL,
  `gettone` int(11) NOT NULL,
  `usr_pers` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`nome`),
  KEY `usr_pers` (`usr_pers`),
  CONSTRAINT `usr_pers` FOREIGN KEY (`usr_pers`) REFERENCES `Utente` (`usr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Servizio`
--

LOCK TABLES `Servizio` WRITE;
/*!40000 ALTER TABLE `Servizio` DISABLE KEYS */;
INSERT INTO `Servizio` VALUES ('1asdasd',3,2,'dfsasss',12,NULL),('asd',2,2,'assss',12,NULL),('entrambi',4,23,'dsfgasdfsa',213,'tommy'),('luca',3,2,'ciasf',12,'luca'),('Manovra',2,1,'Citta',15,NULL),('Ordinario',NULL,2,'Borgo',15,NULL);
/*!40000 ALTER TABLE `Servizio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Svolge`
--

DROP TABLE IF EXISTS `Svolge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Svolge` (
  `usr_utente` varchar(25) NOT NULL,
  `id_servizio` varchar(30) NOT NULL,
  `data_ora` datetime NOT NULL,
  `isCompleto` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`usr_utente`,`id_servizio`,`data_ora`),
  KEY `id_servizio` (`id_servizio`),
  CONSTRAINT `Svolge_ibfk_1` FOREIGN KEY (`usr_utente`) REFERENCES `Utente` (`usr`),
  CONSTRAINT `Svolge_ibfk_2` FOREIGN KEY (`id_servizio`) REFERENCES `Servizio` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Svolge`
--

LOCK TABLES `Svolge` WRITE;
/*!40000 ALTER TABLE `Svolge` DISABLE KEYS */;
/*!40000 ALTER TABLE `Svolge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Utente`
--

DROP TABLE IF EXISTS `Utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Utente` (
  `usr` varchar(25) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `data_arruolo` date DEFAULT NULL,
  `data_nascita` date NOT NULL,
  `cellulare` varchar(16) NOT NULL,
  `id_ruolo` int(11) DEFAULT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `mail` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`usr`),
  KEY `id_grado` (`id_grado`),
  KEY `id_ruolo` (`id_ruolo`),
  CONSTRAINT `id_grado` FOREIGN KEY (`id_grado`) REFERENCES `Grado` (`id`),
  CONSTRAINT `id_ruolo` FOREIGN KEY (`id_ruolo`) REFERENCES `Ruolo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Utente`
--

LOCK TABLES `Utente` WRITE;
/*!40000 ALTER TABLE `Utente` DISABLE KEYS */;
INSERT INTO `Utente` VALUES ('a','2yG3H4rmVcLmk','a','a','2020-01-01','0000-00-00','a',2,2,'a'),('aaaaa','2yEB08sK3IqGU','a','a','0000-00-00','0000-00-00','a',2,2,'a'),('admin','2yn.4fvaTgedM','admin','admin',NULL,'2005-05-21','3669886162',1,NULL,NULL),('luca','2yG9q7O7s42BI','utente','altro','2024-05-30','2024-05-21','1235432',2,5,'maiol@mail'),('tommy','2yR2XZyf9Sdos','tommy','tommy','2024-05-27','2024-05-06','123543',2,6,'mailmail'),('user','2ybX8QkGr0jN.','a','a','0000-00-00','0000-00-00','a',2,2,'a'),('utente','2yc6mVZCACguw','Utente','Genrico','2024-05-29','2024-05-22','123123123',2,3,'mail');
/*!40000 ALTER TABLE `Utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-25 10:51:26
