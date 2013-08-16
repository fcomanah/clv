-- Adminer 3.7.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '-03:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `clv` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `clv`;

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

INSERT INTO `car` (`id_`, `qtd`, `user_session_id`, `id_prd`, `dtc`, `dtm`) VALUES
(145,	2,	'503ae08ca1be87bf0878cc8bc0e4083f',	31,	'2013-08-12 14:12:33',	'0000-00-00 00:00:00'),
(146,	10,	'503ae08ca1be87bf0878cc8bc0e4083f',	29,	'2013-08-12 14:12:40',	'0000-00-00 00:00:00'),
(147,	12,	'4ec3600421a9a0a77628def33763262b',	31,	'2013-08-12 16:57:52',	'0000-00-00 00:00:00'),
(151,	700,	'1dcf71bca48df7fb74a4d225b49cb471',	33,	'2013-08-13 08:51:20',	'0000-00-00 00:00:00'),
(152,	10,	'1dcf71bca48df7fb74a4d225b49cb471',	34,	'2013-08-13 08:51:37',	'0000-00-00 00:00:00'),
(153,	5,	'1dcf71bca48df7fb74a4d225b49cb471',	28,	'2013-08-13 08:51:50',	'0000-00-00 00:00:00'),
(154,	2,	'240888ab9d033f40a3fdf361490598a2',	35,	'2013-08-15 17:06:18',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `ctg`;
CREATE TABLE `ctg` (
  `id_` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nme` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `nme` (`nme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ctg` (`id_`, `nme`) VALUES
(97,	'Ação'),
(72,	'Acessórios de Arquivo'),
(71,	'Agenda de Bolso'),
(68,	'Agenda Diária'),
(69,	'Agenda Escolar'),
(70,	'Agenda Semanal'),
(46,	'Agendas e Calendários'),
(2,	'Alimentos e Bebidas'),
(98,	'Animação'),
(99,	'Anime'),
(90,	'Aparelhos de Áudio Retrô'),
(47,	'Apontadores'),
(48,	'Aquarelas Escolares'),
(5,	'Ar Condicionado e Aquecedores'),
(73,	'Arquivo Morto'),
(74,	'Arquivo Suspenso'),
(50,	'Arquivos e Pastas'),
(3,	'Áudio'),
(96,	'Áudio Automotivo'),
(4,	'Automotivo'),
(49,	'Avental Escolar'),
(100,	'Aventura'),
(6,	'Bebês'),
(7,	'Beleza e Saúde'),
(52,	'Blocos Auto-Adesivos / Post-it'),
(51,	'Blocos de Papel'),
(34,	'Bolo de Chocolate'),
(53,	'Borrachas'),
(8,	'Brinquedos'),
(54,	'Cadeados'),
(55,	'Cadernos'),
(56,	'Caixas de Correspondência'),
(57,	'Caixas Organizacionais'),
(58,	'Calculadoras'),
(9,	'Cama Mesa e Banho'),
(10,	'Câmeras e Filmadoras'),
(59,	'Canetas'),
(61,	'Canetas Hidrográficas / Hidrocor'),
(62,	'Carimbos'),
(11,	'Celulares e Telefones'),
(63,	'Chaveiros'),
(64,	'Clips, Tachinhas e Elásticos'),
(65,	'Colas'),
(101,	'Comédia'),
(66,	'Compassos'),
(67,	'Contadores de Células'),
(102,	'Cursos'),
(122,	'Decanter'),
(93,	'Dock Station e Caixas Bluetooth'),
(103,	'Documentário'),
(104,	'Drama'),
(42,	'Dvd Automotivo'),
(12,	'DVDs e BLU-ray'),
(13,	'Eletrodomésticos'),
(14,	'Eletroportáteis'),
(95,	'Equipamentos para DJ'),
(105,	'Esporte'),
(15,	'Esporte e Lazer'),
(106,	'Faroeste / Western'),
(16,	'Ferramentas e Jardim'),
(107,	'Ficcção'),
(17,	'Filmes e Séries'),
(108,	'Filmes Importados'),
(18,	'Games'),
(40,	'GPS'),
(109,	'Guerra'),
(110,	'Infantil'),
(19,	'Informática'),
(20,	'Informática e Acessórios'),
(21,	'Instrumentos Musicais'),
(37,	'iPod'),
(91,	'Ipod e Acessórios'),
(22,	'Livros'),
(23,	'Malas de Viagem'),
(38,	'Micro System'),
(88,	'Mini System'),
(24,	'Moda e Acessórios'),
(25,	'Móveis e Decoração'),
(92,	'MP Players'),
(39,	'Mp3 Player'),
(26,	'Música'),
(111,	'Musical'),
(43,	'Notebook'),
(27,	'Papelaria'),
(75,	'Pasta Aba Elástica'),
(76,	'Pasta Catálogo'),
(77,	'Pasta Clip'),
(78,	'Pasta com Canaleta/Trilho'),
(79,	'Pasta com Zíper'),
(80,	'Pasta em L'),
(81,	'Pasta Encadernação / Capa Minuto'),
(82,	'Pasta Executiva'),
(84,	'Pasta Maleta'),
(83,	'Pasta Malote'),
(85,	'Pasta Registradora A/Z'),
(86,	'Pasta Sanfonada'),
(28,	'Perfumaria e Cosméticos'),
(29,	'Pet Shop'),
(119,	'Pilhas'),
(112,	'Policial'),
(94,	'Rádio Relógio / Despertador'),
(1,	'raiz'),
(113,	'Religioso / Gospel'),
(30,	'Rélogios e Presentes'),
(114,	'Romance'),
(41,	'Som Automotivo'),
(89,	'Som Portátil'),
(31,	'Suplementos e Vitaminas'),
(115,	'Suspense'),
(32,	'Tablet e Ipad'),
(45,	'Tablets'),
(116,	'Terror'),
(44,	'Ultrabook'),
(33,	'Utilidades Domésticas'),
(121,	'Vinho'),
(36,	'Vodka'),
(35,	'Whisky');

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

INSERT INTO `mnu` (`id_ctg_flh`, `id_ctg_pai`) VALUES
(2,	1),
(3,	1),
(4,	1),
(5,	1),
(6,	1),
(7,	1),
(8,	1),
(9,	1),
(10,	1),
(11,	1),
(12,	1),
(13,	1),
(14,	1),
(15,	1),
(16,	1),
(17,	1),
(18,	1),
(19,	1),
(20,	1),
(21,	1),
(22,	1),
(23,	1),
(24,	1),
(25,	1),
(26,	1),
(27,	1),
(28,	1),
(29,	1),
(30,	1),
(31,	1),
(32,	1),
(33,	1),
(34,	2),
(35,	2),
(36,	2),
(37,	3),
(38,	3),
(39,	3),
(88,	3),
(89,	3),
(90,	3),
(91,	3),
(92,	3),
(93,	3),
(94,	3),
(95,	3),
(96,	3),
(40,	4),
(41,	4),
(42,	4),
(97,	12),
(98,	12),
(99,	12),
(100,	12),
(101,	12),
(102,	12),
(103,	12),
(104,	12),
(105,	12),
(106,	12),
(107,	12),
(108,	12),
(109,	12),
(110,	12),
(111,	12),
(112,	12),
(113,	12),
(114,	12),
(115,	12),
(116,	12),
(43,	19),
(44,	19),
(45,	19),
(46,	27),
(47,	27),
(48,	27),
(49,	27),
(50,	27),
(51,	27),
(52,	27),
(53,	27),
(54,	27),
(55,	27),
(56,	27),
(57,	27),
(58,	27),
(59,	27),
(61,	27),
(62,	27),
(63,	27),
(64,	27),
(65,	27),
(66,	27),
(67,	27),
(119,	27),
(121,	33),
(68,	46),
(69,	46),
(70,	46),
(71,	46),
(72,	50),
(73,	50),
(74,	50),
(75,	50),
(76,	50),
(77,	50),
(78,	50),
(79,	50),
(80,	50),
(122,	121);

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
(28,	'Ultrabook Conversível Dell XPS12-7690',	6316.20,	' Ultrabook Conversível Dell XPS12-7690 com Intel Core i7 8GB 256GB SSD LED 12,5\'\' Touchscreen Windows 8 + Office 365 Home Premium - Assinatura de 1 ano - Microsoft',	'uploads/1376304724.png',	5,	'2013-08-12 07:52:04',	44),
(29,	'Caneta Esferográfica Trilux  - Faber-Castel',	4.49,	'Materiais escolares e de escritório precisam ter qualidade, durabilidade e proporcionar praticidade e conforto. Pensando nisso, a Faber-Castell desenvolveu essa caneta esferográfica que possui design moderno e ergonômico.',	'uploads/1376312336.jpg',	90,	'2013-08-12 09:58:56',	59),
(30,	'Adesivo Personagens Peter Rabbit',	5.00,	'Adesivo tamanho A4 com as personagens do clássico Peter Rabbit.',	'uploads/1376312532.jpg',	50,	'2013-08-12 10:02:12',	8),
(31,	'Agenda Permanente Peixonauta Bola Jandaia ',	4.90,	'As agendas e cadernos se revelam itens fundamentais para a vida escolar, permitindo organizar compromissos e registrar o aprendizado em sala de aula.',	'uploads/1376316606.jpg',	11,	'2013-08-12 11:10:06',	69),
(32,	'Pasta Suspensa Dellokraft Haste Plástico',	19.90,	'Se você procura uma solução de organização para documentos e contratos seus problemas estão resolvidos. A Pasta Suspensa Dellokraft é a melhor maneira de organizar documentos do escritório ou residência. ',	'uploads/1376317003.jpg',	15,	'2013-08-12 11:16:43',	74),
(33,	'Docking Station SoundDock 10 - Ipod e Iphone - Bose ',	3590.14,	'O SoundDock 10 proporciona um som rico em sons graves devido a integração entre a tecnologia Waveguide da Bose e um woofer projetado especialmente para esse produto que equivale a 4 woofers convencionais. ',	'uploads/1376391745.jpg',	700,	'2013-08-13 08:02:25',	93),
(34,	'DVD Festival 100 Anos John Wayne - Guerra - 5 DVDs',	169.90,	'Para comemorar os 100 anos de John Wayne foi lançado este Box incrível com o melhor do galã dos filmes de Guerra. ',	'uploads/1376392846.jpg',	10,	'2013-08-13 08:20:46',	97),
(35,	'Box Exclusivo Cavaleiros do Zodíaco Saga Clássica Completa',	249.90,	'Os cavaleiros do bem vão invadir a sua casa! A saga clássica completa, sem cortes, dos Cavaleiros do Zodíaco, chega agora reunida em um box exclusivo com 21 DVDs.',	'uploads/1376393036.jpg',	2,	'2013-08-13 08:23:56',	98),
(36,	' Blu-ray The Godfather - The Coppola Restoration - 4 Discos',	389.00,	'Blu-ray The Godfather - The Coppola Restoration - 4 Discos - Importado inclui\r\nThe Godfather, The Godfather II e The Godfather III.',	'uploads/1376393247.jpg',	5342,	'2013-08-13 08:27:27',	108),
(37,	'Pilha Recarregável tipo D Ni-Mh 2500mAh com 2 Unidades',	64.90,	'Pode ser utilizada em qualquer equipamento eletroeletrônico no lugar das baterias alcalinas ou comuns, com a vantagem de poderem ser recarregadas em até 1000 vezes, proporcionando uma grande economia.',	'uploads/1376618911.jpg',	42,	'2013-08-15 23:08:31',	119),
(38,	'Decantador Spiegelau 1L Redewhite',	635.00,	'O decantador permite que o vinho entre em contato rapidamente com o ar e assim respire, liberando aromas contidos na garrafa.',	'uploads/1376619250.jpg',	1000003,	'2013-08-15 23:14:10',	122);

DROP TABLE IF EXISTS `trs`;
CREATE TABLE `trs` (
  `id_` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_trs` int(100) unsigned NOT NULL,
  `status` enum('Em andamento','Não foi feito pagamento','Cancelada','Aguardando pagamento','Aprovada','Encaminhando envio','Concluída') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_`),
  UNIQUE KEY `id_trs` (`id_trs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `trs` (`id_`, `id_trs`, `status`) VALUES
(19,	20482715,	'Aprovada'),
(20,	20487053,	'Em andamento');

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
(1,	'admin',	'clv',	'clv@clv.com',	UNHEX('CE8BB372405C89CF8400B914A5D455ACE5FC115C901E7454091262429E78ED70'),	'Construindo',	'Lojas Virtuais',	'2013-08-30',	'2013-07-30 23:18:04',	'0000-00-00 00:00:00');

-- 2013-08-15 23:15:53
