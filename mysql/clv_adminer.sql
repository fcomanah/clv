-- Adminer 3.7.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '-03:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DELIMITER ;;

DROP PROCEDURE IF EXISTS `add_to_car`;;
;;

DROP PROCEDURE IF EXISTS `get_prd`;;
CREATE PROCEDURE `get_prd`(IN `pid` mediumint(8) unsigned)
SELECT * FROM prd WHERE id_=pid;;

DROP PROCEDURE IF EXISTS `ls_car`;;
;;

DROP PROCEDURE IF EXISTS `ls_ctg`;;
;;

DROP PROCEDURE IF EXISTS `ls_prd`;;
CREATE PROCEDURE `ls_prd`()
BEGIN
    SELECT * FROM prd ORDER by nme;
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
  `qtd` tinyint(3) unsigned NOT NULL,
  `user_session_id` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `id_prd` mediumint(8) unsigned NOT NULL,
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_`),
  KEY `car_ibfk_1` (`id_prd`),
  KEY `user_session_id` (`user_session_id`),
  CONSTRAINT `car_ibfk_1` FOREIGN KEY (`id_prd`) REFERENCES `prd` (`id_`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `prc` decimal(5,2) unsigned NOT NULL,
  `dsc` tinytext COLLATE utf8_unicode_ci,
  `img` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `stq` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ctg` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_`),
  KEY `prd_ibfk_1` (`id_ctg`),
  CONSTRAINT `prd_ibfk_1` FOREIGN KEY (`id_ctg`) REFERENCES `ctg` (`id_`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `prd` (`id_`, `nme`, `prc`, `dsc`, `img`, `stq`, `dtc`, `id_ctg`) VALUES
(2,	'motherBoard',	150.00,	'important component to mount a pc.',	'uploads/2013/06/21/mb.png',	10,	'2013-07-15 01:23:08',	1),
(3,	'cpu',	420.00,	'brain of the machine',	'uploads/2013/06/21/cpu.png',	2,	'2013-07-15 01:24:00',	1),
(4,	'cooler',	20.00,	'anti heating',	'uploads/2013/06/21/cooler.png',	2,	'2013-07-15 01:25:06',	1),
(5,	'ram',	60.00,	'random memory',	'uploads/2013/06/21/ram.png',	200,	'2013-07-15 01:26:07',	1),
(6,	'hd',	250.00,	'storage device',	'uploads/2013/06/21/hd.png',	100,	'2013-07-15 01:26:48',	1);

DROP TABLE IF EXISTS `usr`;
CREATE TABLE `usr` (
  `id_` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('user','admin') NOT NULL,
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


-- 2013-07-21 00:12:24