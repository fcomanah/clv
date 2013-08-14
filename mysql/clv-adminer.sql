-- Adminer 3.7.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '-03:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DELIMITER ;;

DROP PROCEDURE IF EXISTS `add_to_cart`;;
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

DROP PROCEDURE IF EXISTS `get_ctg`;;
CREATE PROCEDURE `get_ctg`(IN `id` tinyint)
SELECT * FROM ctg WHERE id_=id;;

DROP PROCEDURE IF EXISTS `get_prd`;;
CREATE PROCEDURE `get_prd`(IN `pid` mediumint(8) unsigned)
SELECT * FROM prd WHERE id_=pid;;

DROP PROCEDURE IF EXISTS `get_usr`;;
CREATE PROCEDURE `get_usr`(IN `uid` int(10) unsigned)
SELECT * FROM usr WHERE id_=uid;;

DROP PROCEDURE IF EXISTS `ls_cart`;;
CREATE PROCEDURE `ls_cart`(uid CHAR(32))
BEGIN
SELECT * FROM car WHERE user_session_id=uid;
END;;

DROP PROCEDURE IF EXISTS `ls_ctg`;;
CREATE PROCEDURE `ls_ctg`()
BEGIN
  SELECT * FROM ctg WHERE id_ > 1 ORDER by nme;
END;;

DROP PROCEDURE IF EXISTS `ls_ctg_flh`;;
CREATE PROCEDURE `ls_ctg_flh`(IN `id` tinyint(3))
BEGIN
  SELECT * 
  FROM ctg
  WHERE id_ IN (
    SELECT id_ctg_flh 
    FROM mnu 
    WHERE id_ctg_pai = id);
END;;

DROP PROCEDURE IF EXISTS `ls_ctg_pai`;;
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

DROP PROCEDURE IF EXISTS `ls_prd`;;
CREATE PROCEDURE `ls_prd`()
BEGIN
  SELECT * FROM prd ORDER by nme;
END;;

DROP PROCEDURE IF EXISTS `ls_prd_from_ctg`;;
CREATE PROCEDURE `ls_prd_from_ctg`(IN `id` tinyint(3))
BEGIN
  SELECT * FROM prd WHERE id_ctg=id ORDER by nme;
END;;

DROP PROCEDURE IF EXISTS `ls_trs`;;
CREATE PROCEDURE `ls_trs`()
BEGIN
  SELECT * FROM trs ORDER by id_trs DESC;
END;;

DROP PROCEDURE IF EXISTS `ls_usr`;;
CREATE PROCEDURE `ls_usr`()
BEGIN
  SELECT * FROM usr ORDER by nme;
END;;

DROP PROCEDURE IF EXISTS `remove_from_cart`;;
CREATE PROCEDURE `remove_from_cart`(IN `cid` mediumint, IN `qty` mediumint)
BEGIN
DECLARE q INT;
UPDATE car SET qtd=qtd-qty, dtm=NOW() WHERE id_=cid;
SELECT qtd INTO q FROM car WHERE id_=cid;
IF q <= 0 THEN
DELETE FROM car WHERE id_=cid;
END IF;
END;;

DROP PROCEDURE IF EXISTS `remove_from_stq`;;
CREATE PROCEDURE `remove_from_stq`(IN `qtd` mediumint(8) unsigned, IN `pid` mediumint(8) unsigned)
UPDATE prd SET stq=stq-qtd WHERE id_=pid;;

DELIMITER ;

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


DROP TABLE IF EXISTS `ctg`;
CREATE TABLE `ctg` (
  `id_` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `mnu`;
CREATE TABLE `mnu` (
  `id_ctg_flh` tinyint(3) unsigned NOT NULL,
  `id_ctg_pai` tinyint(3) unsigned NOT NULL,
  UNIQUE KEY `id_ctg_flh` (`id_ctg_flh`),
  UNIQUE KEY `id_flh_pai` (`id_ctg_flh`,`id_ctg_pai`),
  KEY `mnu_ibfk_1` (`id_ctg_flh`),
  KEY `mnu_ibfk_2` (`id_ctg_pai`),
  CONSTRAINT `mnu_ibfk_1` FOREIGN KEY (`id_ctg_flh`) REFERENCES `ctg` (`id_`),
  CONSTRAINT `mnu_ibfk_2` FOREIGN KEY (`id_ctg_pai`) REFERENCES `ctg` (`id_`)
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


DROP TABLE IF EXISTS `trs`;
CREATE TABLE `trs` (
  `id_` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_trs` int(100) unsigned NOT NULL,
  `status` enum('Em andamento','Não foi feito pagamento','Cancelada','Aguardando pagamento','Aprovada','Encaminhando envio','Concluída') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `id_trs` (`id_trs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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


-- 2013-08-14 19:43:27
