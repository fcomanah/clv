-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 21-Jul-2013 às 00:08
-- Versão do servidor: 5.5.31
-- versão do PHP: 5.4.4-14+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `clv`
--

DELIMITER $$
--
-- Procedures
--
$$

CREATE DEFINER=`clv`@`localhost` PROCEDURE `get_prd`(IN `pid` mediumint(8) unsigned)
SELECT * FROM prd WHERE id_=pid$$

$$

$$

CREATE DEFINER=`clv`@`localhost` PROCEDURE `ls_prd`()
BEGIN
    SELECT * FROM prd ORDER by nme;
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atr`
--

CREATE TABLE IF NOT EXISTS `atr` (
  `id_` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `id_` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qtd` tinyint(3) unsigned NOT NULL,
  `user_session_id` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `id_prd` mediumint(8) unsigned NOT NULL,
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_`),
  KEY `car_ibfk_1` (`id_prd`),
  KEY `user_session_id` (`user_session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `crc`
--

CREATE TABLE IF NOT EXISTS `crc` (
  `id_atr` mediumint(8) unsigned NOT NULL,
  `id_opc` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `id_atr_opc` (`id_atr`,`id_opc`),
  KEY `dsc_ibfk_1` (`id_atr`),
  KEY `dsc_ibfk_2` (`id_opc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ctg`
--

CREATE TABLE IF NOT EXISTS `ctg` (
  `id_` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `ctg`
--

INSERT INTO `ctg` (`id_`, `nme`) VALUES
(2, 'Hardware'),
(1, 'raiz'),
(3, 'Software');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dsc`
--

CREATE TABLE IF NOT EXISTS `dsc` (
  `id_prd` mediumint(8) unsigned NOT NULL,
  `id_atr` mediumint(8) unsigned NOT NULL,
  `id_opc` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `id_prd_atr_opc` (`id_prd`,`id_atr`,`id_opc`),
  KEY `dsc_ibfk_1` (`id_prd`),
  KEY `dsc_ibfk_2` (`id_atr`),
  KEY `dsc_ibfk_3` (`id_opc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mnu`
--

CREATE TABLE IF NOT EXISTS `mnu` (
  `id_ctg_flh` tinyint(3) unsigned NOT NULL,
  `id_ctg_pai` tinyint(3) unsigned NOT NULL,
  UNIQUE KEY `id_flh_pai` (`id_ctg_flh`,`id_ctg_pai`),
  KEY `mnu_ibfk_1` (`id_ctg_flh`),
  KEY `mnu_ibfk_2` (`id_ctg_pai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `opc`
--

CREATE TABLE IF NOT EXISTS `opc` (
  `id_` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prd`
--

CREATE TABLE IF NOT EXISTS `prd` (
  `id_` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `prc` decimal(5,2) unsigned NOT NULL,
  `dsc` tinytext COLLATE utf8_unicode_ci,
  `img` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `stq` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dtc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ctg` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_`),
  KEY `prd_ibfk_1` (`id_ctg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `prd`
--

INSERT INTO `prd` (`id_`, `nme`, `prc`, `dsc`, `img`, `stq`, `dtc`, `id_ctg`) VALUES
(2, 'motherBoard', 150.00, 'important component to mount a pc.', 'uploads/2013/06/21/mb.png', 10, '2013-07-15 04:23:08', 1),
(3, 'cpu', 420.00, 'brain of the machine', 'uploads/2013/06/21/cpu.png', 2, '2013-07-15 04:24:00', 1),
(4, 'cooler', 20.00, 'anti heating', 'uploads/2013/06/21/cooler.png', 2, '2013-07-15 04:25:06', 1),
(5, 'ram', 60.00, 'random memory', 'uploads/2013/06/21/ram.png', 200, '2013-07-15 04:26:07', 1),
(6, 'hd', 250.00, 'storage device', 'uploads/2013/06/21/hd.png', 100, '2013-07-15 04:26:48', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usr`
--

CREATE TABLE IF NOT EXISTS `usr` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`id_prd`) REFERENCES `prd` (`id_`);

--
-- Limitadores para a tabela `crc`
--
ALTER TABLE `crc`
  ADD CONSTRAINT `crc_ibfk_1` FOREIGN KEY (`id_atr`) REFERENCES `atr` (`id_`),
  ADD CONSTRAINT `crc_ibfk_2` FOREIGN KEY (`id_opc`) REFERENCES `opc` (`id_`);

--
-- Limitadores para a tabela `dsc`
--
ALTER TABLE `dsc`
  ADD CONSTRAINT `dsc_ibfk_1` FOREIGN KEY (`id_prd`) REFERENCES `prd` (`id_`),
  ADD CONSTRAINT `dsc_ibfk_2` FOREIGN KEY (`id_atr`) REFERENCES `atr` (`id_`),
  ADD CONSTRAINT `dsc_ibfk_3` FOREIGN KEY (`id_opc`) REFERENCES `opc` (`id_`);

--
-- Limitadores para a tabela `mnu`
--
ALTER TABLE `mnu`
  ADD CONSTRAINT `mnu_ibfk_1` FOREIGN KEY (`id_ctg_flh`) REFERENCES `ctg` (`id_`),
  ADD CONSTRAINT `mnu_ibfk_2` FOREIGN KEY (`id_ctg_pai`) REFERENCES `ctg` (`id_`);

--
-- Limitadores para a tabela `prd`
--
ALTER TABLE `prd`
  ADD CONSTRAINT `prd_ibfk_1` FOREIGN KEY (`id_ctg`) REFERENCES `ctg` (`id_`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
