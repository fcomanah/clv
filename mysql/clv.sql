-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: clv
-- ------------------------------------------------------
-- Server version	5.5.31-0+wheezy1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `atr`
--

DROP TABLE IF EXISTS `atr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atr` (
  `id_` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atr`
--

LOCK TABLES `atr` WRITE;
/*!40000 ALTER TABLE `atr` DISABLE KEYS */;
/*!40000 ALTER TABLE `atr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `car` (
  `id_` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qtd` smallint(5) unsigned NOT NULL,
  `user_session_id` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `id_prd` mediumint(8) unsigned NOT NULL,
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_`),
  KEY `car_ibfk_1` (`id_prd`),
  KEY `user_session_id` (`user_session_id`),
  CONSTRAINT `car_ibfk_1` FOREIGN KEY (`id_prd`) REFERENCES `prd` (`id_`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car`
--

LOCK TABLES `car` WRITE;
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
INSERT INTO `car` VALUES (37,1,'3e52ddf6fae43eafafe8ba463b32016f',5,'2013-08-03 10:27:07','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crc`
--

DROP TABLE IF EXISTS `crc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crc` (
  `id_atr` mediumint(8) unsigned NOT NULL,
  `id_opc` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `id_atr_opc` (`id_atr`,`id_opc`),
  KEY `dsc_ibfk_1` (`id_atr`),
  KEY `dsc_ibfk_2` (`id_opc`),
  CONSTRAINT `crc_ibfk_1` FOREIGN KEY (`id_atr`) REFERENCES `atr` (`id_`),
  CONSTRAINT `crc_ibfk_2` FOREIGN KEY (`id_opc`) REFERENCES `opc` (`id_`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crc`
--

LOCK TABLES `crc` WRITE;
/*!40000 ALTER TABLE `crc` DISABLE KEYS */;
/*!40000 ALTER TABLE `crc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ctg`
--

DROP TABLE IF EXISTS `ctg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctg` (
  `id_` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctg`
--

LOCK TABLES `ctg` WRITE;
/*!40000 ALTER TABLE `ctg` DISABLE KEYS */;
INSERT INTO `ctg` VALUES (2,'Hardware'),(1,'raiz'),(3,'Software');
/*!40000 ALTER TABLE `ctg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dsc`
--

DROP TABLE IF EXISTS `dsc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dsc` (
  `id_prd` mediumint(8) unsigned NOT NULL,
  `id_atr` mediumint(8) unsigned NOT NULL,
  `id_opc` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `id_prd_atr_opc` (`id_prd`,`id_atr`,`id_opc`),
  KEY `dsc_ibfk_1` (`id_prd`),
  KEY `dsc_ibfk_2` (`id_atr`),
  KEY `dsc_ibfk_3` (`id_opc`),
  CONSTRAINT `dsc_ibfk_1` FOREIGN KEY (`id_prd`) REFERENCES `prd` (`id_`),
  CONSTRAINT `dsc_ibfk_2` FOREIGN KEY (`id_atr`) REFERENCES `atr` (`id_`),
  CONSTRAINT `dsc_ibfk_3` FOREIGN KEY (`id_opc`) REFERENCES `opc` (`id_`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dsc`
--

LOCK TABLES `dsc` WRITE;
/*!40000 ALTER TABLE `dsc` DISABLE KEYS */;
/*!40000 ALTER TABLE `dsc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mnu`
--

DROP TABLE IF EXISTS `mnu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mnu` (
  `id_ctg_flh` tinyint(3) unsigned NOT NULL,
  `id_ctg_pai` tinyint(3) unsigned NOT NULL,
  UNIQUE KEY `id_flh_pai` (`id_ctg_flh`,`id_ctg_pai`),
  KEY `mnu_ibfk_1` (`id_ctg_flh`),
  KEY `mnu_ibfk_2` (`id_ctg_pai`),
  CONSTRAINT `mnu_ibfk_1` FOREIGN KEY (`id_ctg_flh`) REFERENCES `ctg` (`id_`),
  CONSTRAINT `mnu_ibfk_2` FOREIGN KEY (`id_ctg_pai`) REFERENCES `ctg` (`id_`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mnu`
--

LOCK TABLES `mnu` WRITE;
/*!40000 ALTER TABLE `mnu` DISABLE KEYS */;
/*!40000 ALTER TABLE `mnu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opc`
--

DROP TABLE IF EXISTS `opc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opc` (
  `id_` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opc`
--

LOCK TABLES `opc` WRITE;
/*!40000 ALTER TABLE `opc` DISABLE KEYS */;
/*!40000 ALTER TABLE `opc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prd`
--

DROP TABLE IF EXISTS `prd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prd` (
  `id_` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `prc` decimal(10,2) unsigned NOT NULL,
  `dsc` tinytext COLLATE utf8_unicode_ci,
  `img` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `stq` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ctg` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_`),
  KEY `prd_ibfk_1` (`id_ctg`),
  CONSTRAINT `prd_ibfk_1` FOREIGN KEY (`id_ctg`) REFERENCES `ctg` (`id_`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prd`
--

LOCK TABLES `prd` WRITE;
/*!40000 ALTER TABLE `prd` DISABLE KEYS */;
INSERT INTO `prd` VALUES (2,'placa-m√£e',150.00,'important component to mount a pc.','uploads/2013/06/21/mb.png',10,'2013-07-15 04:23:08',1),(3,'cpu',420.00,'brain of the machine','uploads/2013/06/21/cpu.png',2,'2013-07-15 04:24:00',1),(4,'cooler',20.00,'anti heating','uploads/2013/06/21/cooler.png',2,'2013-07-15 04:25:06',1),(5,'Boston City Flow',1600.00,'Beatiful travel!','uploads/2013/06/21/ram.png',200,'2013-07-15 04:26:07',1),(6,'disco r√≠gido',250.00,'storage device','uploads/2013/06/21/hd.png',100,'2013-07-15 04:26:48',1);
/*!40000 ALTER TABLE `prd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usr`
--

DROP TABLE IF EXISTS `usr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usr` (
  `id_` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('member','admin') NOT NULL,
  `nme` varchar(30) NOT NULL,
  `email` varchar(80) NOT NULL,
  `pass` varbinary(32) DEFAULT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `date_expires` date NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usr`
--

LOCK TABLES `usr` WRITE;
/*!40000 ALTER TABLE `usr` DISABLE KEYS */;
INSERT INTO `usr` VALUES (76,'member','ze','ze@c.com','Œã≥r@\\âœÑ\0π•‘U¨Â¸\\êtT	bBûxÌp','','','2013-08-31','2013-07-31 11:18:02','0000-00-00 00:00:00'),(74,'member','sarah','sarahsiq@gmail.com','Œã≥r@\\âœÑ\0π•‘U¨Â¸\\êtT	bBûxÌp','Sarah','David Siqueira','2013-08-30','2013-07-31 02:20:12','0000-00-00 00:00:00'),(75,'member','gladson','gladson@gmail.com','Œã≥r@\\âœÑ\0π•‘U¨Â¸\\êtT	bBûxÌp','Gladson','Recieri','2013-08-30','2013-07-31 02:41:34','0000-00-00 00:00:00'),(73,'admin','mfer','mfer@dcc.com','Œã≥r@\\âœÑ\0π•‘U¨Â¸\\êtT	bBûxÌp','Manass√©s','Ferreira Neto','2013-08-30','2013-07-31 02:18:04','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `usr` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-03  7:31:30
