SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS atributo;
CREATE TABLE IF NOT EXISTS atributo (
  id int(100) NOT NULL AUTO_INCREMENT,
  nome varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY nome (nome)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

DROP TABLE IF EXISTS catalogo;
CREATE TABLE IF NOT EXISTS catalogo (
  id_produto int(100) NOT NULL,
  id_categoria int(100) NOT NULL,
  UNIQUE KEY id_prod_cat (id_produto,id_categoria),
  KEY id_categoria (id_categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS categoria;
CREATE TABLE IF NOT EXISTS categoria (
  id int(100) NOT NULL AUTO_INCREMENT,
  nome varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY nome (nome)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

DROP TABLE IF EXISTS descricao;
CREATE TABLE IF NOT EXISTS descricao (
  id_produto int(100) NOT NULL,
  id_detalhe int(100) NOT NULL,
  UNIQUE KEY id_det_prod (id_produto,id_detalhe),
  KEY id_detalhe (id_detalhe)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS detalhe;
CREATE TABLE IF NOT EXISTS detalhe (
  id int(100) NOT NULL AUTO_INCREMENT,
  id_atributo int(100) NOT NULL,
  id_opcao int(100) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY id_descricao (id_atributo,id_opcao),
  KEY id_opcao (id_opcao)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

DROP TABLE IF EXISTS menu;
CREATE TABLE IF NOT EXISTS menu (
  id_categoria int(100) NOT NULL,
  id_categoria_acima int(100) NOT NULL,
  UNIQUE KEY id_cat_acima (id_categoria,id_categoria_acima),
  KEY id_categoria_acima (id_categoria_acima)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS opcao;
CREATE TABLE IF NOT EXISTS opcao (
  id int(100) NOT NULL AUTO_INCREMENT,
  nome varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY nome (nome)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;

DROP TABLE IF EXISTS produto;
CREATE TABLE IF NOT EXISTS produto (
  id int(100) NOT NULL AUTO_INCREMENT,
  nome varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY nome (nome)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;


ALTER TABLE `catalogo`
  ADD CONSTRAINT catalogo_ibfk_1 FOREIGN KEY (id_produto) REFERENCES produto (id),
  ADD CONSTRAINT catalogo_ibfk_2 FOREIGN KEY (id_categoria) REFERENCES categoria (id);

ALTER TABLE `descricao`
  ADD CONSTRAINT descricao_ibfk_1 FOREIGN KEY (id_produto) REFERENCES produto (id),
  ADD CONSTRAINT descricao_ibfk_2 FOREIGN KEY (id_detalhe) REFERENCES detalhe (id);

ALTER TABLE `detalhe`
  ADD CONSTRAINT detalhe_ibfk_1 FOREIGN KEY (id_atributo) REFERENCES atributo (id),
  ADD CONSTRAINT detalhe_ibfk_2 FOREIGN KEY (id_opcao) REFERENCES opcao (id);

ALTER TABLE `menu`
  ADD CONSTRAINT menu_ibfk_1 FOREIGN KEY (id_categoria) REFERENCES categoria (id),
  ADD CONSTRAINT menu_ibfk_2 FOREIGN KEY (id_categoria_acima) REFERENCES categoria (id);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
