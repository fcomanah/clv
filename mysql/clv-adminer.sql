-- Adminer 3.7.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '-03:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `clv`;
CREATE DATABASE `clv` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `clv`;

DELIMITER ;;

CREATE PROCEDURE `add_to_cart`(IN `uid` char(32), IN `pid` mediumint, IN `qty` mediumint)
BEGIN
DECLARE cid INT;
DECLARE s INT;
DECLARE q INT;
SELECT id_ INTO cid FROM car WHERE user_session_id=uid AND id_prd=pid;
IF cid > 0 THEN
SELECT stq INTO s FROM prd WHERE id_=pid;
SELECT qtd INTO q FROM car WHERE id_=cid;
IF (q+qty) < s THEN
UPDATE car SET qtd=qtd+qty, dtm=NOW() WHERE id_=cid;
ELSE
UPDATE car SET qtd=s, dtm=NOW() WHERE id_=cid;
END IF;
ELSE 
INSERT INTO car (user_session_id, id_prd, qtd) VALUES (uid, pid, qty);
END IF;
END;;

CREATE PROCEDURE `get_prd`(IN `pid` mediumint(8) unsigned)
SELECT * FROM prd WHERE id_=pid;;

CREATE PROCEDURE `get_usr`(IN `uid` int(10) unsigned)
SELECT * FROM usr WHERE id_=uid;;

;;

CREATE PROCEDURE `ls_ctg`()
BEGIN
  SELECT * FROM ctg WHERE id_ > 1 ORDER by nme;
END;;

CREATE PROCEDURE `ls_prd`()
BEGIN
  SELECT * FROM prd ORDER by nme;
END;;

CREATE PROCEDURE `ls_usr`()
BEGIN
  SELECT * FROM usr ORDER by nme;
END;;

CREATE PROCEDURE `remove_from_cart`(IN `cid` mediumint, IN `qty` mediumint)
BEGIN
DECLARE q INT;
UPDATE car SET qtd=qtd-qty, dtm=NOW() WHERE id_=cid;
SELECT qtd INTO q FROM car WHERE id_=cid;
IF q <= 0 THEN
DELETE FROM car WHERE id_=cid;
END IF;
END;;

DELIMITER ;

DROP TABLE IF EXISTS `atr`;
CREATE TABLE `atr` (
  `id_` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `car`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `car` (`id_`, `qtd`, `user_session_id`, `id_prd`, `dtc`, `dtm`) VALUES
(55,	2,	'3e52ddf6fae43eafafe8ba463b32016f',	4,	'2013-08-03 09:34:31',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `crc`;
CREATE TABLE `crc` (
  `id_atr` mediumint(8) unsigned NOT NULL,
  `id_opc` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `id_atr_opc` (`id_atr`,`id_opc`),
  KEY `dsc_ibfk_1` (`id_atr`),
  KEY `dsc_ibfk_2` (`id_opc`),
  CONSTRAINT `crc_ibfk_1` FOREIGN KEY (`id_atr`) REFERENCES `atr` (`id_`),
  CONSTRAINT `crc_ibfk_2` FOREIGN KEY (`id_opc`) REFERENCES `opc` (`id_`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `ctg`;
CREATE TABLE `ctg` (
  `id_` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ctg` (`id_`, `nme`) VALUES
(2,	'Hardware'),
(1,	'raiz'),
(3,	'Software');

DROP TABLE IF EXISTS `dsc`;
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


DROP TABLE IF EXISTS `mnu`;
CREATE TABLE `mnu` (
  `id_ctg_flh` tinyint(3) unsigned NOT NULL,
  `id_ctg_pai` tinyint(3) unsigned NOT NULL,
  UNIQUE KEY `id_flh_pai` (`id_ctg_flh`,`id_ctg_pai`),
  KEY `mnu_ibfk_1` (`id_ctg_flh`),
  KEY `mnu_ibfk_2` (`id_ctg_pai`),
  CONSTRAINT `mnu_ibfk_1` FOREIGN KEY (`id_ctg_flh`) REFERENCES `ctg` (`id_`),
  CONSTRAINT `mnu_ibfk_2` FOREIGN KEY (`id_ctg_pai`) REFERENCES `ctg` (`id_`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `opc`;
CREATE TABLE `opc` (
  `id_` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `prd`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `prd` (`id_`, `nme`, `prc`, `dsc`, `img`, `stq`, `dtc`, `id_ctg`) VALUES
(2,	'placa-mãe',	150.00,	'important component to mount a pc.',	'uploads/2013/06/21/mb.png',	10,	'2013-07-15 01:23:08',	1),
(3,	'cpu',	420.00,	'brain of the machine',	'uploads/2013/06/21/cpu.png',	2,	'2013-07-15 01:24:00',	1),
(4,	'cooler',	20.00,	'anti heating',	'uploads/2013/06/21/cooler.png',	2,	'2013-07-15 01:25:06',	1),
(5,	'Boston City Flow',	1600.00,	'Beautiful travel!',	'uploads/2013/06/21/ram.png',	200,	'2013-07-15 01:26:07',	1),
(6,	'disco rígido',	250.00,	'storage device',	'uploads/2013/06/21/hd.png',	100,	'2013-07-15 01:26:48',	1);

DROP TABLE IF EXISTS `usr`;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `usr` (`id_`, `type`, `nme`, `email`, `pass`, `first_name`, `last_name`, `date_expires`, `date_created`, `date_modified`) VALUES
(76,	'member',	'ze',	'ze@c.com',	UNHEX('CE8BB372405C89CF8400B914A5D455ACE5FC115C901E7454091262429E78ED70'),	'',	'',	'2013-08-31',	'2013-07-31 08:18:02',	'0000-00-00 00:00:00'),
(74,	'member',	'sarah',	'sarahsiq@gmail.com',	UNHEX('CE8BB372405C89CF8400B914A5D455ACE5FC115C901E7454091262429E78ED70'),	'Sarah',	'David Siqueira',	'2013-08-30',	'2013-07-30 23:20:12',	'0000-00-00 00:00:00'),
(75,	'member',	'gladson',	'gladson@gmail.com',	UNHEX('CE8BB372405C89CF8400B914A5D455ACE5FC115C901E7454091262429E78ED70'),	'Gladson',	'Recieri',	'2013-08-30',	'2013-07-30 23:41:34',	'0000-00-00 00:00:00'),
(73,	'admin',	'mfer',	'mfer@dcc.com',	UNHEX('CE8BB372405C89CF8400B914A5D455ACE5FC115C901E7454091262429E78ED70'),	'Manassés',	'Ferreira Neto',	'2013-08-30',	'2013-07-30 23:18:04',	'0000-00-00 00:00:00');

-- 2013-08-03 09:34:55