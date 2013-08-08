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

CREATE PROCEDURE `get_ctg`(IN `id` tinyint)
SELECT * FROM ctg WHERE id_=id;;

CREATE PROCEDURE `get_prd`(IN `pid` mediumint(8) unsigned)
SELECT * FROM prd WHERE id_=pid;;

CREATE PROCEDURE `get_usr`(IN `uid` int(10) unsigned)
SELECT * FROM usr WHERE id_=uid;;

CREATE PROCEDURE `ls_cart`(uid CHAR(32))
BEGIN
SELECT * FROM car WHERE user_session_id=uid;
END;;

CREATE PROCEDURE `ls_ctg`()
BEGIN
  SELECT * FROM ctg WHERE id_ > 1 ORDER by nme;
END;;

CREATE PROCEDURE `ls_ctg_flh`(IN `id` tinyint(3))
BEGIN
  SELECT * 
  FROM ctg
  WHERE id_ IN (
    SELECT id_ctg_flh 
    FROM mnu 
    WHERE id_ctg_pai = id);
END;;

CREATE PROCEDURE `ls_ctg_pai`(IN `id` tinyint(3))
BEGIN
  SELECT * 
  FROM ctg
  WHERE id_ IN (
    SELECT id_ctg_pai 
    FROM mnu 
    WHERE id_ctg_flh = id 
    AND id_ctg_pai > 1);
END;;

CREATE PROCEDURE `ls_prd`()
BEGIN
  SELECT * FROM prd ORDER by nme;
END;;

CREATE PROCEDURE `ls_prd_from_ctg`(IN `id` tinyint(3))
BEGIN
  SELECT * FROM prd WHERE id_ctg=id ORDER by nme;
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
(77,	1,	'1ef319e36ec6821e4ca667f181596992',	2,	'2013-08-03 23:32:59',	'0000-00-00 00:00:00'),
(78,	1,	'2af5cb9bbd1d95a0a89234838afda154',	3,	'2013-08-04 09:45:21',	'2013-08-04 09:46:34'),
(79,	7,	'2af5cb9bbd1d95a0a89234838afda154',	2,	'2013-08-04 09:46:23',	'0000-00-00 00:00:00'),
(97,	1,	'a3abf5d946e07c70962acf58e14f8b4d',	4,	'2013-08-05 16:01:38',	'0000-00-00 00:00:00'),
(109,	19,	'd74a4e7eb8aa675b5d45d775946e1351',	5,	'2013-08-06 10:00:42',	'0000-00-00 00:00:00'),
(110,	1,	'd74a4e7eb8aa675b5d45d775946e1351',	4,	'2013-08-06 10:02:17',	'0000-00-00 00:00:00'),
(111,	1,	'd9888cf173fa55b97c1c435182c174ac',	5,	'2013-08-06 20:07:31',	'0000-00-00 00:00:00'),
(112,	3,	'd9888cf173fa55b97c1c435182c174ac',	2,	'2013-08-06 20:07:48',	'0000-00-00 00:00:00'),
(115,	46,	'4e252102f9519bbe4e691ff3489926ad',	10,	'2013-08-07 20:51:16',	'0000-00-00 00:00:00'),
(116,	1,	'3e52ddf6fae43eafafe8ba463b32016f',	10,	'2013-08-08 00:46:48',	'0000-00-00 00:00:00');

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
(11,	'1/s'),
(14,	'Adesivos'),
(8,	'BIOS'),
(4,	'CPU'),
(7,	'DISCO RÍGIDO'),
(9,	'FREQUÊNCIA'),
(2,	'Hardware'),
(12,	'hertz'),
(10,	'MHz'),
(6,	'MOTHERBOARD'),
(1,	'raiz'),
(5,	'RAM'),
(3,	'Software'),
(13,	'Travel');

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

INSERT INTO `mnu` (`id_ctg_flh`, `id_ctg_pai`) VALUES
(2,	1),
(3,	1),
(4,	2),
(5,	2),
(7,	2),
(8,	6),
(9,	4),
(9,	5),
(10,	9),
(11,	10),
(12,	11),
(13,	1),
(14,	1);

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
(2,	'placa-mãe',	150.00,	'important component to mount a pc.',	'uploads/2013/06/21/mb.png',	10,	'2013-07-15 01:23:08',	6),
(3,	'cpu',	420.00,	'brain of the machine',	'uploads/2013/06/21/cpu.png',	2,	'2013-07-15 01:24:00',	4),
(4,	'cooler',	20.00,	'anti heating',	'uploads/2013/06/21/cooler.png',	2,	'2013-07-15 01:25:06',	2),
(5,	'Boston City Flow Ultra big expendable Name Product example',	1599.99,	'Beautiful travel!',	'uploads/2013/06/21/ram.png',	200,	'2013-07-15 01:26:07',	13),
(6,	'disco rígido',	250.00,	'storage device',	'uploads/2013/06/21/hd.png',	100,	'2013-07-15 01:26:48',	7),
(9,	'Tux',	5.00,	'Adesivo Sensacional como mascote do Linux!',	'uploads/2013/08/07/Tux.png',	100,	'2013-08-07 13:48:35',	14),
(10,	'Android Evolution',	10.00,	'Evolução das versões do Android.',	'uploads/2013/08/07/evolution-android.jpg',	50,	'2013-08-07 14:05:16',	14);

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

-- 2013-08-08 02:10:16