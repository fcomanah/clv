-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `clv`;
CREATE DATABASE `clv` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `clv`;

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador` (
  `email` varchar(32) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `nome` varchar(32) DEFAULT NULL,
  `sobrenome` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `administrador` (`email`, `senha`, `nome`, `sobrenome`) VALUES
('clvu@clv.com',	'905e68470532cd67e600ee9cc376bba1',	'clv_nome',	'clv_sobrenome');

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE `carrinho` (
  `chave` int(11) NOT NULL,
  `sku` int(11) NOT NULL,
  `quantidade` varchar(45) DEFAULT NULL,
  `modificacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`chave`,`sku`),
  KEY `skufkidx` (`sku`),
  KEY `chavefkidx` (`chave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto` (
  `sku` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` decimal(13,2) NOT NULL,
  `imagem` varchar(80) NOT NULL,
  `quantidadeestoque` int(11) NOT NULL,
  PRIMARY KEY (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `produto` (`sku`, `nome`, `descricao`, `preco`, `imagem`, `quantidadeestoque`) VALUES
(1,	'Celular',	'Nokia 5800 XpressMusic is a mobile device with 3.2',	50.00,	'mobile.jpg',	1000),
(2,	'LCD',	'Monitor 19\"',	699.50,	'lcd.jpg',	1000),
(3,	'Mouse',	'Ã“tico para Notebook',	23.45,	'mouse.jpg',	1000),
(4,	'PenDrive',	'8GB',	11.23,	'flash-disk.jpg',	1000),
(5,	'Bateria',	'Para NoteBooks Dell',	56.77,	'charger.jpg',	1000),
(6,	'Drive CD',	'Leitor e Gravador',	555.33,	'cdrom-drive.jpg',	1000),
(7,	'HardDrive',	'80GB - 7200RPM',	137.00,	'hard-drive.jpg',	1000),
(8,	'SSD',	'128GB',	294.05,	'ssd.png',	1000),
(9,	'Camisa',	'Algodão',	149.99,	'camisa.jpg',	100);

DROP TABLE IF EXISTS `sessao`;
CREATE TABLE `sessao` (
  `chave` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`chave`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `sessao` (`chave`, `ip`, `browser`, `criacao`) VALUES
(1,	'::1',	'Mozilla Firefox 47.0',	'2016-07-02 13:05:39');

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `status` (`codigo`, `nome`, `descricao`) VALUES
(1,	'Em Andamento',	''),
(2,	'NÃ£o foi feito pagamento',	'Entrar em Contato'),
(3,	'Cancelada',	''),
(4,	'Aguardando pagamento',	'Verificar no Bcash'),
(5,	'Aprovada',	'Bla'),
(6,	'Encaminhando envio',	'O estoque  Ã© acionado.'),
(7,	'ConcluÃ­da',	'Quando o cliente paga e o produto Ã© enviado.'),
(8,	'Outro Nome',	'Outra DescriÃ§Ã£o'),
(9,	'Mais um',	'Outro');

DROP TABLE IF EXISTS `transacao`;
CREATE TABLE `transacao` (
  `id` int(11) NOT NULL,
  `idexterno` int(100) NOT NULL,
  `valor` decimal(13,2) NOT NULL,
  `codigostatus` int(11) NOT NULL,
  `criacao` varchar(50) NOT NULL,
  `modificacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_trs` (`idexterno`),
  KEY `codigostatus_fk` (`codigostatus`),
  CONSTRAINT `codigostatus_fk` FOREIGN KEY (`codigostatus`) REFERENCES `status` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2016-07-02 14:44:35
