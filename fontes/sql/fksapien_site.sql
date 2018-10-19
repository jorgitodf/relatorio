-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 09, 2016 at 05:42 PM
-- Server version: 5.5.48-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fksapien_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `cotacesta_cesta_basica`
--

DROP TABLE IF EXISTS `cotacesta_cesta_basica`;
CREATE TABLE IF NOT EXISTS `cotacesta_cesta_basica` (
  `seq_cesta_basica` int(11) NOT NULL AUTO_INCREMENT,
  `desc_cesta` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_cesta_basica` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`seq_cesta_basica`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cotacesta_cotacao`
--

DROP TABLE IF EXISTS `cotacesta_cotacao`;
CREATE TABLE IF NOT EXISTS `cotacesta_cotacao` (
  `seq_cotacao` int(11) NOT NULL AUTO_INCREMENT,
  `seq_produto` int(11) NOT NULL,
  `seq_mercado` int(11) NOT NULL,
  `seq_cliente` int(11) DEFAULT NULL,
  `vlr_dieese` decimal(9,2) DEFAULT '0.00',
  `vlr_venda` decimal(9,2) NOT NULL,
  `dt_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`seq_cotacao`),
  KEY `fk_cotacao_cliente` (`seq_cliente`),
  KEY `fk_cotacao_mercado` (`seq_mercado`),
  KEY `fk_cotacao_produto` (`seq_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `cotacesta_item_cesta`
--

DROP TABLE IF EXISTS `cotacesta_item_cesta`;
CREATE TABLE IF NOT EXISTS `cotacesta_item_cesta` (
  `seq_item_cesta` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cesta_basica` int(11) NOT NULL,
  `seq_produto` int(11) NOT NULL,
  `ind_st_item_cesta` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`seq_item_cesta`),
  KEY `fk_item_cesta_cesta_basica` (`seq_cesta_basica`),
  KEY `fk_item_cesta_produto` (`seq_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cotacesta_mercado`
--

DROP TABLE IF EXISTS `cotacesta_mercado`;
CREATE TABLE IF NOT EXISTS `cotacesta_mercado` (
  `seq_mercado` int(11) NOT NULL AUTO_INCREMENT,
  `desc_mercado` varchar(300) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `endereco` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `ind_st_mercado` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  `seq_cliente` int(11) NOT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_mercado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `cotacesta_produto`
--

DROP TABLE IF EXISTS `cotacesta_produto`;
CREATE TABLE IF NOT EXISTS `cotacesta_produto` (
  `seq_produto` int(11) NOT NULL AUTO_INCREMENT,
  `desc_produto` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_produto` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  `seq_cliente` int(11) NOT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `ect_bairro`
--

DROP TABLE IF EXISTS `ect_bairro`;
CREATE TABLE IF NOT EXISTS `ect_bairro` (
  `cod_bairro` int(11) NOT NULL,
  `cod_localidade` int(11) NOT NULL,
  `desc_bairro` varchar(144) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`cod_bairro`),
  KEY `fk_localidade_bairro` (`cod_localidade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ect_localidade`
--

DROP TABLE IF EXISTS `ect_localidade`;
CREATE TABLE IF NOT EXISTS `ect_localidade` (
  `cod_localidade` int(11) NOT NULL,
  `sg_uf` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `desc_localidade` varchar(144) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `num_cep` int(11) DEFAULT NULL,
  `cod_municipio` varchar(7) COLLATE latin1_general_ci DEFAULT NULL,
  `ind_tp_localidade` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `cod_situacao` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `cod_localidade_pai` int(11) DEFAULT NULL,
  `ind_st_ativo` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`cod_localidade`),
  KEY `fk_localidade_localidade_pai` (`cod_localidade_pai`),
  KEY `fk_uf` (`sg_uf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ect_logradouro`
--

DROP TABLE IF EXISTS `ect_logradouro`;
CREATE TABLE IF NOT EXISTS `ect_logradouro` (
  `num_cep` int(11) NOT NULL,
  `ind_tp_logradouro` varchar(72) COLLATE latin1_general_ci DEFAULT NULL,
  `desc_logradouro` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `desc_complemento` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `cod_localidade` int(11) DEFAULT NULL,
  `cod_bairro_inicial` int(11) NOT NULL,
  `cod_bairro_final` int(11) DEFAULT NULL,
  `ind_usa_tipo` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `ind_grande_usuario` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `ind_st_ativo` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`num_cep`),
  KEY `fk_bairro_inicial_logradouro` (`cod_bairro_inicial`),
  KEY `fk_bairro_final_logradouro` (`cod_bairro_final`),
  KEY `fk_localidade_logradouro` (`cod_localidade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ect_uf`
--

DROP TABLE IF EXISTS `ect_uf`;
CREATE TABLE IF NOT EXISTS `ect_uf` (
  `sg_uf` varchar(2) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `cod_uf` varchar(2) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `desc_uf` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `desc_uf_maiusculo` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_ativo` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_encerramento_ativo` datetime DEFAULT NULL,
  PRIMARY KEY (`sg_uf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fks_banner`
--

DROP TABLE IF EXISTS `fks_banner`;
CREATE TABLE IF NOT EXISTS `fks_banner` (
  `seq_banner` int(11) NOT NULL AUTO_INCREMENT,
  `seq_usuario` int(11) NOT NULL,
  `desc_banner` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `link` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ind_tp_banner` varchar(5) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ind_st_banner` varchar(5) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `dt_lancamento` datetime DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `file_content` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `file_data` longblob,
  PRIMARY KEY (`seq_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_cliente`
--

DROP TABLE IF EXISTS `fks_cliente`;
CREATE TABLE IF NOT EXISTS `fks_cliente` (
  `seq_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `seq_usuario` int(11) NOT NULL,
  `cpf_cnpj` varchar(14) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nome_cliente` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `endereco` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `bairro` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `desc_cidade` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `uf` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `home_page` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nickname` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `senha` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_tp_cliente` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_cliente` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_lancamento` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_cliente_sistema`
--

DROP TABLE IF EXISTS `fks_cliente_sistema`;
CREATE TABLE IF NOT EXISTS `fks_cliente_sistema` (
  `seq_cliente` int(11) NOT NULL,
  `seq_sistema` int(11) NOT NULL,
  `endereco_ftp` varchar(500) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_ftp` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_lancamento` datetime DEFAULT NULL,
  KEY `fk_seq_cliente_sistema_fk` (`seq_cliente`),
  KEY `fk_seq_sistema_cliente_fk` (`seq_sistema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fks_config`
--

DROP TABLE IF EXISTS `fks_config`;
CREATE TABLE IF NOT EXISTS `fks_config` (
  `seq_config` int(11) NOT NULL AUTO_INCREMENT,
  `txt_email_cobranca` text COLLATE latin1_general_ci,
  `txt_fatura_cobranca` text COLLATE latin1_general_ci,
  `txt_instrucao_boleto` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`seq_config`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_dominio`
--

DROP TABLE IF EXISTS `fks_dominio`;
CREATE TABLE IF NOT EXISTS `fks_dominio` (
  `nome_coluna` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `desc_codigo` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `desc_estado` varchar(100) COLLATE latin1_general_ci DEFAULT '',
  `ind_st_dominio` varchar(10) COLLATE latin1_general_ci DEFAULT '1',
  PRIMARY KEY (`nome_coluna`,`desc_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fks_download`
--

DROP TABLE IF EXISTS `fks_download`;
CREATE TABLE IF NOT EXISTS `fks_download` (
  `seq_download` int(11) NOT NULL AUTO_INCREMENT,
  `seq_usuario` int(11) NOT NULL,
  `desc_titulo` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `desc_complemento` varchar(5000) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `link` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `file_content` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `file_data` longblob,
  `ind_categoria_download` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `ind_st_download` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `dt_lancamento` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_download`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_fatura`
--

DROP TABLE IF EXISTS `fks_fatura`;
CREATE TABLE IF NOT EXISTS `fks_fatura` (
  `seq_fatura` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `num_fatura` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `dt_vencimento` date NOT NULL,
  `dt_pagamento` date DEFAULT NULL,
  `vlr_pago` decimal(9,2) DEFAULT '0.00',
  `ind_st_fatura` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `dt_lancamento` datetime DEFAULT NULL,
  `md5_fatura` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`seq_fatura`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_item_fatura`
--

DROP TABLE IF EXISTS `fks_item_fatura`;
CREATE TABLE IF NOT EXISTS `fks_item_fatura` (
  `seq_item_fatura` int(11) NOT NULL AUTO_INCREMENT,
  `seq_fatura` int(11) NOT NULL,
  `seq_produto_servico` int(11) NOT NULL,
  `desc_complemento` text COLLATE latin1_general_ci,
  `vlr_fatura` decimal(9,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`seq_item_fatura`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=76 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_item_pedido`
--

DROP TABLE IF EXISTS `fks_item_pedido`;
CREATE TABLE IF NOT EXISTS `fks_item_pedido` (
  `seq_item_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `seq_pedido` int(11) NOT NULL,
  `seq_produto_servico` int(11) NOT NULL,
  `qtd_item` decimal(9,2) NOT NULL,
  `vlr_item` decimal(9,2) NOT NULL,
  PRIMARY KEY (`seq_item_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_noticia`
--

DROP TABLE IF EXISTS `fks_noticia`;
CREATE TABLE IF NOT EXISTS `fks_noticia` (
  `seq_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `seq_usuario` int(11) NOT NULL,
  `desc_titulo` varchar(500) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `desc_complemento` varchar(8000) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_noticia` datetime DEFAULT NULL,
  `ind_tp_categoria` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `ind_tp_destaque` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `ind_tp_noticia` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_noticia` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_lancamento` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_noticia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_parceiro`
--

DROP TABLE IF EXISTS `fks_parceiro`;
CREATE TABLE IF NOT EXISTS `fks_parceiro` (
  `seq_parceiro` int(11) NOT NULL AUTO_INCREMENT,
  `seq_usuario` int(11) NOT NULL,
  `sg_parceiro` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nome_parceiro` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `link` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `logo_tipo` longblob,
  `ind_tp_parceiro` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_parceiro` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_lancamento` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_parceiro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_pedido`
--

DROP TABLE IF EXISTS `fks_pedido`;
CREATE TABLE IF NOT EXISTS `fks_pedido` (
  `seq_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `num_pedido` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_pedido` datetime NOT NULL,
  PRIMARY KEY (`seq_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_produto_servico`
--

DROP TABLE IF EXISTS `fks_produto_servico`;
CREATE TABLE IF NOT EXISTS `fks_produto_servico` (
  `seq_produto_servico` int(11) NOT NULL AUTO_INCREMENT,
  `seq_usuario` int(11) NOT NULL,
  `sg_produto_servico` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `desc_produto_servico` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `desc_complemento` varchar(8000) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_tp_produto_servico` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_produto_servico` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_lancamento` datetime DEFAULT NULL,
  `vlr_minimo` decimal(9,2) DEFAULT '0.00',
  `exibir_site` bit(1) DEFAULT NULL,
  PRIMARY KEY (`seq_produto_servico`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_sistema`
--

DROP TABLE IF EXISTS `fks_sistema`;
CREATE TABLE IF NOT EXISTS `fks_sistema` (
  `seq_sistema` int(11) NOT NULL AUTO_INCREMENT,
  `seq_usuario` int(11) NOT NULL,
  `sg_sistema` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nome_sistema` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `desc_sistema` varchar(5000) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_tp_sistema` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_sistema` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_lancamento` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_sistema`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `fks_usuario`
--

DROP TABLE IF EXISTS `fks_usuario`;
CREATE TABLE IF NOT EXISTS `fks_usuario` (
  `seq_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nome_usuario` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `senha` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_tp_usuario` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ind_st_usuario` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dt_lancamento` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_andamento_pedido`
--

DROP TABLE IF EXISTS `siaf_andamento_pedido`;
CREATE TABLE IF NOT EXISTS `siaf_andamento_pedido` (
  `seq_andamento_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `seq_pedido` int(11) DEFAULT NULL,
  `dt_andamento` date NOT NULL,
  `desc_parecer` text NOT NULL,
  `ind_tp_andamento` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_andamento_pedido`),
  KEY `fk_siaf_andamento_pedido_siaf_pedido` (`seq_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_auditoria`
--

DROP TABLE IF EXISTS `siaf_auditoria`;
CREATE TABLE IF NOT EXISTS `siaf_auditoria` (
  `seq_auditoria` int(11) NOT NULL AUTO_INCREMENT,
  `seq_usuario` int(11) NOT NULL,
  `seq_cliente` int(11) NOT NULL,
  `ind_tp_auditoria` varchar(10) NOT NULL,
  `desc_auditoria` text NOT NULL,
  `dt_lancamento` datetime NOT NULL,
  PRIMARY KEY (`seq_auditoria`),
  KEY `fk_siaf_auditoria_cliente` (`seq_cliente`),
  KEY `fk_siaf_auditoria_usuario` (`seq_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_carga`
--

DROP TABLE IF EXISTS `siaf_carga`;
CREATE TABLE IF NOT EXISTS `siaf_carga` (
  `seq_carga` int(11) NOT NULL AUTO_INCREMENT,
  `seq_patrimonio` int(11) DEFAULT NULL,
  `seq_departamento_origem` int(11) DEFAULT NULL,
  `seq_departamento_destino` int(11) DEFAULT NULL,
  `seq_usuario` int(11) DEFAULT NULL,
  `dt_inclusao` date NOT NULL,
  `dt_exclusao` date DEFAULT NULL,
  `dt_atualizacao` date NOT NULL,
  `desc_ocorrencia` text NOT NULL,
  PRIMARY KEY (`seq_carga`),
  KEY `fk_siaf_carga_siaf_departamento_destino` (`seq_departamento_destino`),
  KEY `fk_siaf_carga_siaf_departamento_origem` (`seq_departamento_origem`),
  KEY `fk_siaf_carga_siaf_patrimonio` (`seq_patrimonio`),
  KEY `fk_siaf_carga_siaf_usuario` (`seq_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_cargo`
--

DROP TABLE IF EXISTS `siaf_cargo`;
CREATE TABLE IF NOT EXISTS `siaf_cargo` (
  `seq_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `seq_departamento` int(11) NOT NULL,
  `desc_cargo` varchar(150) DEFAULT NULL,
  `desc_observacao` text,
  `ind_st_cargo` varchar(10) DEFAULT NULL,
  `ind_tp_cargo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_cargo`),
  KEY `fk_siaf_cargo_cliente` (`seq_cliente`),
  KEY `fk_siaf_cargo_departamento` (`seq_departamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_conta_bancaria`
--

DROP TABLE IF EXISTS `siaf_conta_bancaria`;
CREATE TABLE IF NOT EXISTS `siaf_conta_bancaria` (
  `seq_conta_bancaria` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `num_conta_bancaria` varchar(20) DEFAULT NULL,
  `desc_conta_bancaria` varchar(100) DEFAULT NULL,
  `boleto_carteira` varchar(10) DEFAULT NULL,
  `boleto_vlr_acrescimo` varchar(10) DEFAULT NULL,
  `boleto_desc_avisos` varchar(10) DEFAULT NULL,
  `boleto_desc_instrucao` varchar(10) DEFAULT NULL,
  `ind_tp_conta_bancaria` varchar(10) DEFAULT NULL,
  `ind_st_conta_bancaria` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_conta_bancaria`),
  KEY `fk_siaf_contabancaria_cliente` (`seq_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_departamento`
--

DROP TABLE IF EXISTS `siaf_departamento`;
CREATE TABLE IF NOT EXISTS `siaf_departamento` (
  `seq_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `sg_departamento` varchar(10) DEFAULT NULL,
  `desc_departamento` varchar(150) DEFAULT NULL,
  `desc_observacao` text,
  `ind_st_departamento` varchar(10) DEFAULT NULL,
  `ind_tp_departamento` varchar(10) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `senha_email` varchar(10) DEFAULT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_departamento`),
  KEY `fk_siaf_departamento_cliente` (`seq_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_familia`
--

DROP TABLE IF EXISTS `siaf_familia`;
CREATE TABLE IF NOT EXISTS `siaf_familia` (
  `seq_familia` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) DEFAULT NULL,
  `desc_familia` varchar(50) NOT NULL,
  PRIMARY KEY (`seq_familia`),
  KEY `fk_siaf_familia_fks_cliente` (`seq_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_familia_pessoa`
--

DROP TABLE IF EXISTS `siaf_familia_pessoa`;
CREATE TABLE IF NOT EXISTS `siaf_familia_pessoa` (
  `seq_familia_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `seq_pessoa` int(11) DEFAULT NULL,
  `seq_familia` int(11) DEFAULT NULL,
  `ind_parentesco` varchar(10) NOT NULL,
  PRIMARY KEY (`seq_familia_pessoa`),
  KEY `fk_siaf_familia_pessoa_siaf_familia` (`seq_familia`),
  KEY `fk_siaf_familia_pessoa_siaf_pessoa` (`seq_pessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_fechamento_mensal`
--

DROP TABLE IF EXISTS `siaf_fechamento_mensal`;
CREATE TABLE IF NOT EXISTS `siaf_fechamento_mensal` (
  `seq_fechamento_mensal` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `ano_mes_referencia` varchar(6) DEFAULT NULL,
  `vlr_abertura` decimal(9,2) DEFAULT NULL,
  `vlr_fechamento` decimal(9,2) DEFAULT NULL,
  `desc_observacao` text,
  PRIMARY KEY (`seq_fechamento_mensal`),
  KEY `fk_siaf_fechamentomensal_cliente` (`seq_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_fornecedor`
--

DROP TABLE IF EXISTS `siaf_fornecedor`;
CREATE TABLE IF NOT EXISTS `siaf_fornecedor` (
  `seq_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `cpf_cnpj` varchar(14) DEFAULT NULL,
  `nome_razao_social` varchar(150) DEFAULT NULL,
  `num_cep` int(11) DEFAULT NULL,
  `cep_complemento` varchar(50) DEFAULT NULL,
  `ind_tp_fornecedor` varchar(10) DEFAULT NULL,
  `ind_st_fornecedor` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_fornecedor`),
  KEY `fk_siaf_fornecedor_ect_logradouro` (`num_cep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_historico`
--

DROP TABLE IF EXISTS `siaf_historico`;
CREATE TABLE IF NOT EXISTS `siaf_historico` (
  `seq_historico` int(11) NOT NULL AUTO_INCREMENT,
  `seq_pessoa` int(11) DEFAULT NULL,
  `cod_matricula` varchar(10) DEFAULT NULL,
  `dt_historico` date DEFAULT NULL,
  `desc_observacao` text,
  `ind_tp_historico` varchar(10) DEFAULT NULL,
  `ind_st_historico` varchar(10) DEFAULT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_historico`),
  KEY `fk_siaf_historico_pessoa` (`seq_pessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_item_orcamento`
--

DROP TABLE IF EXISTS `siaf_item_orcamento`;
CREATE TABLE IF NOT EXISTS `siaf_item_orcamento` (
  `seq_item_orcamento` int(11) NOT NULL AUTO_INCREMENT,
  `seq_orcamento` int(11) DEFAULT NULL,
  `seq_plano_conta` int(11) DEFAULT NULL,
  `vlr_orcado_mes` decimal(9,2) DEFAULT NULL,
  `ind_restricao_orcamento` varchar(10) DEFAULT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_item_orcamento`),
  KEY `fk_siaf_itemorcamento_orcamento` (`seq_orcamento`),
  KEY `fk_siaf_itemorcamento_planoconta` (`seq_plano_conta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_item_pedido`
--

DROP TABLE IF EXISTS `siaf_item_pedido`;
CREATE TABLE IF NOT EXISTS `siaf_item_pedido` (
  `seq_item_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `seq_pedido` int(11) DEFAULT NULL,
  `ordem_item` int(11) DEFAULT NULL,
  `desc_item` varchar(800) NOT NULL,
  `qtd_item` double(8,2) NOT NULL,
  `vlr_item` double(8,2) DEFAULT NULL,
  `ind_unid_medida` varchar(10) DEFAULT NULL,
  `ind_st_item_pedido` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_item_pedido`),
  KEY `fk_siaf_item_pedido_siaf_pedido` (`seq_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_item_pedido_material`
--

DROP TABLE IF EXISTS `siaf_item_pedido_material`;
CREATE TABLE IF NOT EXISTS `siaf_item_pedido_material` (
  `seq_item_pedido_material` int(11) NOT NULL AUTO_INCREMENT,
  `seq_pedido` int(11) DEFAULT NULL,
  `qtd_pedido` double(8,2) NOT NULL,
  `qtd_autorizada` double(8,2) DEFAULT NULL,
  `vlr_item` double(8,2) DEFAULT NULL,
  `ind_st_item_pedido` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_item_pedido_material`),
  KEY `fk_siaf_item_pedido_material_siaf_pedido` (`seq_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_lancamento`
--

DROP TABLE IF EXISTS `siaf_lancamento`;
CREATE TABLE IF NOT EXISTS `siaf_lancamento` (
  `seq_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `seq_usuario` int(11) DEFAULT NULL,
  `seq_plano_conta` int(11) DEFAULT NULL,
  `seq_fornecedor` int(11) DEFAULT NULL,
  `num_lancamento` varchar(20) DEFAULT NULL,
  `num_documento` varchar(20) DEFAULT NULL,
  `ano_mes_referencia` varchar(6) DEFAULT NULL,
  `dt_emissao` date DEFAULT NULL,
  `dt_vencimento` date DEFAULT NULL,
  `dt_pagamento` date DEFAULT NULL,
  `vlr_cobrado` decimal(9,2) DEFAULT NULL,
  `vlr_pago` decimal(9,2) DEFAULT NULL,
  `desc_observacao` text,
  `ind_forma_pgto` varchar(10) DEFAULT NULL,
  `cod_banco_cheque` varchar(10) DEFAULT NULL,
  `cod_agencia_cheque` varchar(10) DEFAULT NULL,
  `num_cheque` varchar(10) DEFAULT NULL,
  `ind_cod_liquidacao` varchar(10) DEFAULT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_lancamento`),
  KEY `fk_siaf_lancamento_cliente` (`seq_cliente`),
  KEY `fk_siaf_lancamento_fornecedor` (`seq_fornecedor`),
  KEY `fk_siaf_lancamento_planoconta` (`seq_plano_conta`),
  KEY `fk_siaf_lancamento_usuario` (`seq_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_local_material`
--

DROP TABLE IF EXISTS `siaf_local_material`;
CREATE TABLE IF NOT EXISTS `siaf_local_material` (
  `seq_local_material` int(11) NOT NULL AUTO_INCREMENT,
  `seq_material` int(11) DEFAULT NULL,
  `num_ordem` int(11) DEFAULT NULL,
  `desc_local` varchar(20) DEFAULT NULL,
  `ind_localizacao` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_local_material`),
  KEY `fk_siaf_local_material_siaf_material` (`seq_material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_material`
--

DROP TABLE IF EXISTS `siaf_material`;
CREATE TABLE IF NOT EXISTS `siaf_material` (
  `seq_material` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) DEFAULT NULL,
  `desc_material` varchar(100) NOT NULL,
  `desc_complemento` varchar(800) DEFAULT NULL,
  `dt_cadastro` date NOT NULL,
  `dt_atualizacao` date DEFAULT NULL,
  `ind_st_material` varchar(10) DEFAULT NULL,
  `ind_tp_material` varchar(10) DEFAULT NULL,
  `ind_unid_medida` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_material`),
  KEY `fk_siaf_material_fks_cliente` (`seq_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_menu`
--

DROP TABLE IF EXISTS `siaf_menu`;
CREATE TABLE IF NOT EXISTS `siaf_menu` (
  `seq_menu` int(11) NOT NULL AUTO_INCREMENT,
  `seq_menu_pai` int(11) DEFAULT NULL,
  `num_ordem` int(11) NOT NULL DEFAULT '1',
  `desc_menu` varchar(150) NOT NULL,
  `link` varchar(200) DEFAULT '',
  PRIMARY KEY (`seq_menu`),
  KEY `fk_siaf_menu_siaf_menu` (`seq_menu_pai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_orcamento`
--

DROP TABLE IF EXISTS `siaf_orcamento`;
CREATE TABLE IF NOT EXISTS `siaf_orcamento` (
  `seq_orcamento` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `sg_orcamento` varchar(20) DEFAULT NULL,
  `desc_orcamento` varchar(150) DEFAULT NULL,
  `ind_tp_orcamento` varchar(10) DEFAULT NULL,
  `ind_st_orcamento` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_orcamento`),
  KEY `fk_siaf_orcamento_cliente` (`seq_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_patrimonio`
--

DROP TABLE IF EXISTS `siaf_patrimonio`;
CREATE TABLE IF NOT EXISTS `siaf_patrimonio` (
  `seq_patrimonio` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) DEFAULT NULL,
  `seq_material` int(11) DEFAULT NULL,
  `num_tombamento` varchar(20) NOT NULL,
  `desc_complemento` varchar(800) DEFAULT NULL,
  `vlr_patrimonio` double(8,2) DEFAULT NULL,
  `dt_entrada` date NOT NULL,
  `dt_atualizacao` date DEFAULT NULL,
  `ind_tp_entrada` varchar(10) DEFAULT NULL,
  `ind_st_patrimonio` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_patrimonio`),
  KEY `fk_siaf_patrimonio_fks_cliente` (`seq_cliente`),
  KEY `fk_siaf_patrimonio_siaf_material` (`seq_material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_pedido`
--

DROP TABLE IF EXISTS `siaf_pedido`;
CREATE TABLE IF NOT EXISTS `siaf_pedido` (
  `seq_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) DEFAULT NULL,
  `seq_usuario` int(11) DEFAULT NULL,
  `num_pedido` varchar(20) NOT NULL,
  `dt_pedido` date NOT NULL,
  `ind_st_pedido` varchar(10) DEFAULT NULL,
  `ind_tp_pedido` varchar(10) DEFAULT NULL,
  `desc_objetivo` text,
  `desc_justificativa` text,
  `desc_observacao` text,
  PRIMARY KEY (`seq_pedido`),
  KEY `fk_siaf_pedido_fks_cliente` (`seq_cliente`),
  KEY `fk_siaf_pedido_siaf_usuario` (`seq_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_perfil`
--

DROP TABLE IF EXISTS `siaf_perfil`;
CREATE TABLE IF NOT EXISTS `siaf_perfil` (
  `seq_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `desc_perfil` varchar(150) NOT NULL,
  PRIMARY KEY (`seq_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_perfil_menu`
--

DROP TABLE IF EXISTS `siaf_perfil_menu`;
CREATE TABLE IF NOT EXISTS `siaf_perfil_menu` (
  `seq_perfil_menu` int(11) NOT NULL AUTO_INCREMENT,
  `seq_perfil` int(11) NOT NULL,
  `seq_menu` int(11) NOT NULL,
  PRIMARY KEY (`seq_perfil_menu`),
  KEY `fk_siaf_perfil_menu_siaf_menu` (`seq_menu`),
  KEY `fk_reference_60` (`seq_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_pessoa`
--

DROP TABLE IF EXISTS `siaf_pessoa`;
CREATE TABLE IF NOT EXISTS `siaf_pessoa` (
  `seq_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `nrcep` int(11) DEFAULT NULL,
  `cep_complemento` varchar(50) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `tel_residencial` varchar(50) DEFAULT NULL,
  `tel_comercial` varchar(50) DEFAULT NULL,
  `tel_celular` varchar(50) DEFAULT NULL,
  `senha` varchar(10) DEFAULT NULL,
  `ind_sexo` varchar(10) DEFAULT NULL,
  `ind_estado_civil` varchar(10) DEFAULT NULL,
  `ind_profissao` varchar(10) DEFAULT NULL,
  `ind_renda_familiar` varchar(10) DEFAULT NULL,
  `ind_st_pessoa` varchar(10) DEFAULT NULL,
  `foto_name` varchar(100) DEFAULT NULL,
  `foto_type` varchar(5) DEFAULT NULL,
  `foto_size` int(11) DEFAULT NULL,
  `foto_content` longblob,
  PRIMARY KEY (`seq_pessoa`),
  KEY `fk_siaf_pessoa_cliente` (`seq_cliente`),
  KEY `fk_siaf_pessoa_ect_logradouro` (`nrcep`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_pessoa_cargo`
--

DROP TABLE IF EXISTS `siaf_pessoa_cargo`;
CREATE TABLE IF NOT EXISTS `siaf_pessoa_cargo` (
  `seq_pessoa_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cargo` int(11) DEFAULT NULL,
  `seq_pessoa` int(11) DEFAULT NULL,
  `dt_inicio` date DEFAULT NULL,
  `dt_final` date DEFAULT NULL,
  `desc_ocorrencia` text,
  `ind_tp_cargo_dep` varchar(10) DEFAULT NULL,
  `dt_atualizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`seq_pessoa_cargo`),
  KEY `fk_siaf_pessoa_cargo` (`seq_cargo`),
  KEY `fk_siaf_pessoacargo_pessoa` (`seq_pessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_plano_conta`
--

DROP TABLE IF EXISTS `siaf_plano_conta`;
CREATE TABLE IF NOT EXISTS `siaf_plano_conta` (
  `seq_plano_conta` int(11) NOT NULL AUTO_INCREMENT,
  `tco_seq_plano_conta` int(11) DEFAULT NULL,
  `seq_conta_bancaria` int(11) DEFAULT NULL,
  `seq_cliente` int(11) NOT NULL,
  `num_plano_conta` varchar(20) DEFAULT NULL,
  `desc_plano_conta` varchar(150) DEFAULT NULL,
  `ind_tp_plano_conta` varchar(10) DEFAULT NULL,
  `ind_st_plano_conta` varchar(10) DEFAULT NULL,
  `ind_funcao_plano_conta` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_plano_conta`),
  KEY `fk_siaf_planoconta_cliente` (`seq_cliente`),
  KEY `fk_siaf_planoconta_contabancaria` (`seq_conta_bancaria`),
  KEY `fk_siaf_planoconta_planoconta` (`tco_seq_plano_conta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_curso`
--

DROP TABLE IF EXISTS `siaf_trn_curso`;
CREATE TABLE IF NOT EXISTS `siaf_trn_curso` (
  `seq_curso` int(11) NOT NULL AUTO_INCREMENT,
  `num_curso` varchar(20) NOT NULL,
  `desc_curso` varchar(200) NOT NULL,
  `dt_cadastro` date NOT NULL,
  `dt_atualizacao` date DEFAULT NULL,
  `ind_tp_trn_curso` varchar(10) DEFAULT NULL,
  `ind_st_trn_curso` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_curso_disciplina`
--

DROP TABLE IF EXISTS `siaf_trn_curso_disciplina`;
CREATE TABLE IF NOT EXISTS `siaf_trn_curso_disciplina` (
  `seq_disciplina` int(11) DEFAULT NULL,
  `seq_curso` int(11) DEFAULT NULL,
  `ind_tp_trn_disciplina` varchar(10) NOT NULL,
  KEY `fk_trn_curso_disciplina_curso` (`seq_curso`),
  KEY `fk_trn_curso_disciplina_disciplina` (`seq_disciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_desconto`
--

DROP TABLE IF EXISTS `siaf_trn_desconto`;
CREATE TABLE IF NOT EXISTS `siaf_trn_desconto` (
  `seq_desconto` int(11) NOT NULL AUTO_INCREMENT,
  `seq_pessoa` int(11) DEFAULT NULL,
  `perc_desconto` double(8,2) DEFAULT NULL,
  `vlr_desconto` double(8,2) DEFAULT NULL,
  `dt_validade` date NOT NULL,
  `ind_tp_trn_desconto` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_desconto`),
  KEY `fk_trn_desconto_pessoa` (`seq_pessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_diario`
--

DROP TABLE IF EXISTS `siaf_trn_diario`;
CREATE TABLE IF NOT EXISTS `siaf_trn_diario` (
  `seq_diario` int(11) NOT NULL AUTO_INCREMENT,
  `seq_disciplina` int(11) DEFAULT NULL,
  `seq_semestre` int(11) DEFAULT NULL,
  `num_total_aulas` double(8,2) NOT NULL,
  `num_total_faltas` double(8,2) NOT NULL,
  `num_nota_final` double(8,2) NOT NULL,
  `dt_cadastro` date NOT NULL,
  `dt_atualizacao` date DEFAULT NULL,
  `ind_tp_trn_diario` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_diario`),
  KEY `fk_trn_diario_disciplina` (`seq_disciplina`),
  KEY `fk_trn_diario_semestre` (`seq_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_disciplina`
--

DROP TABLE IF EXISTS `siaf_trn_disciplina`;
CREATE TABLE IF NOT EXISTS `siaf_trn_disciplina` (
  `seq_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `num_disciplina` varchar(10) NOT NULL,
  `desc_disciplina` varchar(200) NOT NULL,
  `desc_complemento` text,
  `qtd_credito` double(8,2) NOT NULL,
  `carga_horaria` double(8,2) DEFAULT NULL,
  `dt_cadastro` date NOT NULL,
  `dt_atualizacao` date DEFAULT NULL,
  `ind_st_trn_disciplina` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_disciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_disciplina_requisito`
--

DROP TABLE IF EXISTS `siaf_trn_disciplina_requisito`;
CREATE TABLE IF NOT EXISTS `siaf_trn_disciplina_requisito` (
  `seq_disciplina_requisito` int(11) NOT NULL AUTO_INCREMENT,
  `seq_disciplina` int(11) DEFAULT NULL,
  PRIMARY KEY (`seq_disciplina_requisito`),
  KEY `fk_trn_disciplina_requisito_disciplina` (`seq_disciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_horario`
--

DROP TABLE IF EXISTS `siaf_trn_horario`;
CREATE TABLE IF NOT EXISTS `siaf_trn_horario` (
  `seq_horario` int(11) NOT NULL AUTO_INCREMENT,
  `seq_turma` int(11) DEFAULT NULL,
  `ind_trn_horario` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_horario`),
  KEY `fk_trn_horario_turma` (`seq_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_matricula`
--

DROP TABLE IF EXISTS `siaf_trn_matricula`;
CREATE TABLE IF NOT EXISTS `siaf_trn_matricula` (
  `seq_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `seq_pessoa` int(11) DEFAULT NULL,
  `seq_semestre` int(11) DEFAULT NULL,
  `seq_turno` int(11) DEFAULT NULL,
  `cod_matricula` varchar(20) NOT NULL,
  `dt_matricula` date NOT NULL,
  `dt_trancamento` date DEFAULT NULL,
  `ind_st_trn_matricula` varchar(10) DEFAULT NULL,
  `ind_tp_trn_matricula` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_matricula`),
  KEY `fk_trn_matricula_pessoa` (`seq_pessoa`),
  KEY `fk_trn_matricula_semestre` (`seq_semestre`),
  KEY `fk_trn_matricula_turno` (`seq_turno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_matricula_turma`
--

DROP TABLE IF EXISTS `siaf_trn_matricula_turma`;
CREATE TABLE IF NOT EXISTS `siaf_trn_matricula_turma` (
  `seq_matricula_turma` int(11) NOT NULL AUTO_INCREMENT,
  `seq_turma` int(11) DEFAULT NULL,
  `seq_matricula` int(11) DEFAULT NULL,
  PRIMARY KEY (`seq_matricula_turma`),
  KEY `fk_trn_matricula_turma_matricula` (`seq_matricula`),
  KEY `fk_trn_matricula_turma_turma` (`seq_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_professor`
--

DROP TABLE IF EXISTS `siaf_trn_professor`;
CREATE TABLE IF NOT EXISTS `siaf_trn_professor` (
  `seq_professor` int(11) NOT NULL AUTO_INCREMENT,
  `seq_pessoa` int(11) DEFAULT NULL,
  PRIMARY KEY (`seq_professor`),
  KEY `fk_trn_professor_siaf_pessoa` (`seq_pessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_semestre`
--

DROP TABLE IF EXISTS `siaf_trn_semestre`;
CREATE TABLE IF NOT EXISTS `siaf_trn_semestre` (
  `seq_semestre` int(11) NOT NULL AUTO_INCREMENT,
  `ano_num_semestre` varchar(10) NOT NULL,
  `dt_inicio` date NOT NULL,
  `dt_termino` date NOT NULL,
  `dt_abertura` date NOT NULL,
  `dt_fechamento` date NOT NULL,
  `ind_st_trn_semestre` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_turma`
--

DROP TABLE IF EXISTS `siaf_trn_turma`;
CREATE TABLE IF NOT EXISTS `siaf_trn_turma` (
  `seq_turma` int(11) NOT NULL AUTO_INCREMENT,
  `num_turma` varchar(10) NOT NULL,
  `desc_turma` varchar(200) NOT NULL,
  `qtd_maxima` int(11) DEFAULT NULL,
  `dt_cadastro` date NOT NULL,
  `dt_atualizacao` date DEFAULT NULL,
  `ind_st_trn_turma` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`seq_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_turma__professor`
--

DROP TABLE IF EXISTS `siaf_trn_turma__professor`;
CREATE TABLE IF NOT EXISTS `siaf_trn_turma__professor` (
  `seq_turma_professor` int(11) NOT NULL AUTO_INCREMENT,
  `seq_professor` int(11) DEFAULT NULL,
  `seq_turma` int(11) DEFAULT NULL,
  PRIMARY KEY (`seq_turma_professor`),
  KEY `fk_trn_turma_professor_profefssor` (`seq_professor`),
  KEY `fk_trn_turma_professor_turma` (`seq_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_trn_turno`
--

DROP TABLE IF EXISTS `siaf_trn_turno`;
CREATE TABLE IF NOT EXISTS `siaf_trn_turno` (
  `seq_turno` int(11) NOT NULL AUTO_INCREMENT,
  `ind_tp_trn_turno` varchar(10) DEFAULT NULL,
  `qtd_credito` double(8,2) DEFAULT NULL,
  `vlr_credito` double(8,2) DEFAULT NULL,
  `qtd_credito_matricula` double(8,2) DEFAULT NULL,
  `vlr_credito_matricula` double(8,2) DEFAULT NULL,
  `linha_boleto1` varchar(250) DEFAULT NULL,
  `linha_boleto2` varchar(250) DEFAULT NULL,
  `linha_boleto3` varchar(250) DEFAULT NULL,
  `linha_boleto4` varchar(250) DEFAULT NULL,
  `linha_boleto5` varchar(250) DEFAULT NULL,
  `linha_boleto6` varchar(250) DEFAULT NULL,
  `linha_boleto7` varchar(250) DEFAULT NULL,
  `linha_boleto8` varchar(250) DEFAULT NULL,
  `linha_boleto9` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`seq_turno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siaf_usuario`
--

DROP TABLE IF EXISTS `siaf_usuario`;
CREATE TABLE IF NOT EXISTS `siaf_usuario` (
  `seq_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `seq_cliente` int(11) NOT NULL,
  `seq_perfil` int(11) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `ass_content` longblob,
  `dt_cadastro` datetime DEFAULT NULL,
  `dt_ultimo_login` datetime DEFAULT NULL,
  `ind_st_usuario` varchar(10) DEFAULT NULL,
  `linguagem` varchar(5) DEFAULT 'br',
  `ass_name` varchar(50) DEFAULT NULL,
  `ass_type` varchar(10) DEFAULT NULL,
  `ass_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`seq_usuario`),
  KEY `fk_siaf_usuario_cliente` (`seq_cliente`),
  KEY `fk_siaf_usuario_siaf_perfil` (`seq_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_historico`
--
DROP VIEW IF EXISTS `vw_historico`;
CREATE TABLE IF NOT EXISTS `vw_historico` (
`seq_historico` int(11)
,`cod_matricula` varchar(10)
,`dt_historico` date
,`desc_observacao` text
,`ind_tp_historico` varchar(10)
,`ind_st_historico` varchar(10)
,`seq_pessoa` int(11)
,`nome` varchar(150)
,`ind_st_pessoa` varchar(10)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_logradouro`
--
DROP VIEW IF EXISTS `vw_logradouro`;
CREATE TABLE IF NOT EXISTS `vw_logradouro` (
`num_cep` int(11)
,`ind_tp_logradouro` varchar(72)
,`desc_logradouro` varchar(200)
,`desc_complemento` varchar(200)
,`sg_uf` varchar(2)
,`desc_localidade` varchar(144)
,`desc_bairro` varchar(144)
,`logradouro_completo` text
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ultimo_historico`
--
DROP VIEW IF EXISTS `vw_ultimo_historico`;
CREATE TABLE IF NOT EXISTS `vw_ultimo_historico` (
`seq_historico` int(11)
,`seq_pessoa` int(11)
);
-- --------------------------------------------------------

--
-- Structure for view `vw_historico`
--
DROP TABLE IF EXISTS `vw_historico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fksapien`@`localhost` SQL SECURITY DEFINER VIEW `vw_historico` AS select `h`.`seq_historico` AS `seq_historico`,`h`.`cod_matricula` AS `cod_matricula`,`h`.`dt_historico` AS `dt_historico`,`h`.`desc_observacao` AS `desc_observacao`,`h`.`ind_tp_historico` AS `ind_tp_historico`,`h`.`ind_st_historico` AS `ind_st_historico`,`p`.`seq_pessoa` AS `seq_pessoa`,`p`.`nome` AS `nome`,`p`.`ind_st_pessoa` AS `ind_st_pessoa` from ((`siaf_historico` `h` join `vw_ultimo_historico` `uh` on((`h`.`seq_historico` = `uh`.`seq_historico`))) join `siaf_pessoa` `p` on((`h`.`seq_pessoa` = `p`.`seq_pessoa`)));

-- --------------------------------------------------------

--
-- Structure for view `vw_logradouro`
--
DROP TABLE IF EXISTS `vw_logradouro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fksapien`@`localhost` SQL SECURITY DEFINER VIEW `vw_logradouro` AS select `log`.`num_cep` AS `num_cep`,`log`.`ind_tp_logradouro` AS `ind_tp_logradouro`,`log`.`desc_logradouro` AS `desc_logradouro`,`log`.`desc_complemento` AS `desc_complemento`,`loc`.`sg_uf` AS `sg_uf`,`loc`.`desc_localidade` AS `desc_localidade`,`bai`.`desc_bairro` AS `desc_bairro`,concat(`log`.`ind_tp_logradouro`,' ',`log`.`desc_logradouro`,', ',`bai`.`desc_bairro`,', ',`loc`.`desc_localidade`,' - ',`loc`.`sg_uf`) AS `logradouro_completo` from (((`ect_logradouro` `log` join `ect_localidade` `loc` on((`log`.`cod_localidade` = `loc`.`cod_localidade`))) join `ect_bairro` `bai` on((`log`.`cod_bairro_inicial` = `bai`.`cod_bairro`))) left join `ect_uf` `uf` on((`loc`.`sg_uf` = `uf`.`sg_uf`)));

-- --------------------------------------------------------

--
-- Structure for view `vw_ultimo_historico`
--
DROP TABLE IF EXISTS `vw_ultimo_historico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fksapien`@`localhost` SQL SECURITY DEFINER VIEW `vw_ultimo_historico` AS select max(`h1`.`seq_historico`) AS `seq_historico`,`h1`.`seq_pessoa` AS `seq_pessoa` from `siaf_historico` `h1` group by `h1`.`seq_pessoa`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cotacesta_cotacao`
--
ALTER TABLE `cotacesta_cotacao`
  ADD CONSTRAINT `fk_cotacao_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`),
  ADD CONSTRAINT `fk_cotacao_mercado` FOREIGN KEY (`seq_mercado`) REFERENCES `cotacesta_mercado` (`seq_mercado`),
  ADD CONSTRAINT `fk_cotacao_produto` FOREIGN KEY (`seq_produto`) REFERENCES `cotacesta_produto` (`seq_produto`);

--
-- Constraints for table `cotacesta_item_cesta`
--
ALTER TABLE `cotacesta_item_cesta`
  ADD CONSTRAINT `fk_item_cesta_cesta_basica` FOREIGN KEY (`seq_cesta_basica`) REFERENCES `cotacesta_cesta_basica` (`seq_cesta_basica`),
  ADD CONSTRAINT `fk_item_cesta_produto` FOREIGN KEY (`seq_produto`) REFERENCES `cotacesta_produto` (`seq_produto`);

--
-- Constraints for table `siaf_andamento_pedido`
--
ALTER TABLE `siaf_andamento_pedido`
  ADD CONSTRAINT `fk_siaf_andamento_pedido_siaf_pedido` FOREIGN KEY (`seq_pedido`) REFERENCES `siaf_pedido` (`seq_pedido`);

--
-- Constraints for table `siaf_auditoria`
--
ALTER TABLE `siaf_auditoria`
  ADD CONSTRAINT `fk_siaf_auditoria_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`),
  ADD CONSTRAINT `fk_siaf_auditoria_usuario` FOREIGN KEY (`seq_usuario`) REFERENCES `siaf_usuario` (`seq_usuario`);

--
-- Constraints for table `siaf_carga`
--
ALTER TABLE `siaf_carga`
  ADD CONSTRAINT `fk_siaf_carga_siaf_departamento_destino` FOREIGN KEY (`seq_departamento_destino`) REFERENCES `siaf_departamento` (`seq_departamento`),
  ADD CONSTRAINT `fk_siaf_carga_siaf_departamento_origem` FOREIGN KEY (`seq_departamento_origem`) REFERENCES `siaf_departamento` (`seq_departamento`),
  ADD CONSTRAINT `fk_siaf_carga_siaf_patrimonio` FOREIGN KEY (`seq_patrimonio`) REFERENCES `siaf_patrimonio` (`seq_patrimonio`),
  ADD CONSTRAINT `fk_siaf_carga_siaf_usuario` FOREIGN KEY (`seq_usuario`) REFERENCES `siaf_usuario` (`seq_usuario`);

--
-- Constraints for table `siaf_cargo`
--
ALTER TABLE `siaf_cargo`
  ADD CONSTRAINT `fk_siaf_cargo_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`),
  ADD CONSTRAINT `fk_siaf_cargo_departamento` FOREIGN KEY (`seq_departamento`) REFERENCES `siaf_departamento` (`seq_departamento`);

--
-- Constraints for table `siaf_conta_bancaria`
--
ALTER TABLE `siaf_conta_bancaria`
  ADD CONSTRAINT `fk_siaf_contabancaria_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`);

--
-- Constraints for table `siaf_departamento`
--
ALTER TABLE `siaf_departamento`
  ADD CONSTRAINT `fk_siaf_departamento_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`);

--
-- Constraints for table `siaf_familia`
--
ALTER TABLE `siaf_familia`
  ADD CONSTRAINT `fk_siaf_familia_fks_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`);

--
-- Constraints for table `siaf_familia_pessoa`
--
ALTER TABLE `siaf_familia_pessoa`
  ADD CONSTRAINT `fk_siaf_familia_pessoa_siaf_familia` FOREIGN KEY (`seq_familia`) REFERENCES `siaf_familia` (`seq_familia`),
  ADD CONSTRAINT `fk_siaf_familia_pessoa_siaf_pessoa` FOREIGN KEY (`seq_pessoa`) REFERENCES `siaf_pessoa` (`seq_pessoa`);

--
-- Constraints for table `siaf_fechamento_mensal`
--
ALTER TABLE `siaf_fechamento_mensal`
  ADD CONSTRAINT `fk_siaf_fechamentomensal_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`);

--
-- Constraints for table `siaf_fornecedor`
--
ALTER TABLE `siaf_fornecedor`
  ADD CONSTRAINT `fk_siaf_fornecedor_ect_logradouro` FOREIGN KEY (`num_cep`) REFERENCES `ect_logradouro` (`num_cep`);

--
-- Constraints for table `siaf_historico`
--
ALTER TABLE `siaf_historico`
  ADD CONSTRAINT `fk_siaf_historico_pessoa` FOREIGN KEY (`seq_pessoa`) REFERENCES `siaf_pessoa` (`seq_pessoa`);

--
-- Constraints for table `siaf_item_orcamento`
--
ALTER TABLE `siaf_item_orcamento`
  ADD CONSTRAINT `fk_siaf_itemorcamento_orcamento` FOREIGN KEY (`seq_orcamento`) REFERENCES `siaf_orcamento` (`seq_orcamento`),
  ADD CONSTRAINT `fk_siaf_itemorcamento_planoconta` FOREIGN KEY (`seq_plano_conta`) REFERENCES `siaf_plano_conta` (`seq_plano_conta`);

--
-- Constraints for table `siaf_item_pedido`
--
ALTER TABLE `siaf_item_pedido`
  ADD CONSTRAINT `fk_siaf_item_pedido_siaf_pedido` FOREIGN KEY (`seq_pedido`) REFERENCES `siaf_pedido` (`seq_pedido`);

--
-- Constraints for table `siaf_item_pedido_material`
--
ALTER TABLE `siaf_item_pedido_material`
  ADD CONSTRAINT `fk_siaf_item_pedido_material_siaf_pedido` FOREIGN KEY (`seq_pedido`) REFERENCES `siaf_pedido` (`seq_pedido`);

--
-- Constraints for table `siaf_lancamento`
--
ALTER TABLE `siaf_lancamento`
  ADD CONSTRAINT `fk_siaf_lancamento_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`),
  ADD CONSTRAINT `fk_siaf_lancamento_fornecedor` FOREIGN KEY (`seq_fornecedor`) REFERENCES `siaf_fornecedor` (`seq_fornecedor`),
  ADD CONSTRAINT `fk_siaf_lancamento_planoconta` FOREIGN KEY (`seq_plano_conta`) REFERENCES `siaf_plano_conta` (`seq_plano_conta`),
  ADD CONSTRAINT `fk_siaf_lancamento_usuario` FOREIGN KEY (`seq_usuario`) REFERENCES `siaf_usuario` (`seq_usuario`);

--
-- Constraints for table `siaf_local_material`
--
ALTER TABLE `siaf_local_material`
  ADD CONSTRAINT `fk_siaf_local_material_siaf_material` FOREIGN KEY (`seq_material`) REFERENCES `siaf_material` (`seq_material`);

--
-- Constraints for table `siaf_material`
--
ALTER TABLE `siaf_material`
  ADD CONSTRAINT `fk_siaf_material_fks_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`);

--
-- Constraints for table `siaf_menu`
--
ALTER TABLE `siaf_menu`
  ADD CONSTRAINT `fk_siaf_menu_siaf_menu` FOREIGN KEY (`seq_menu_pai`) REFERENCES `siaf_menu` (`seq_menu`);

--
-- Constraints for table `siaf_orcamento`
--
ALTER TABLE `siaf_orcamento`
  ADD CONSTRAINT `fk_siaf_orcamento_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`);

--
-- Constraints for table `siaf_patrimonio`
--
ALTER TABLE `siaf_patrimonio`
  ADD CONSTRAINT `fk_siaf_patrimonio_fks_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`),
  ADD CONSTRAINT `fk_siaf_patrimonio_siaf_material` FOREIGN KEY (`seq_material`) REFERENCES `siaf_material` (`seq_material`);

--
-- Constraints for table `siaf_pedido`
--
ALTER TABLE `siaf_pedido`
  ADD CONSTRAINT `fk_siaf_pedido_fks_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`),
  ADD CONSTRAINT `fk_siaf_pedido_siaf_usuario` FOREIGN KEY (`seq_usuario`) REFERENCES `siaf_usuario` (`seq_usuario`);

--
-- Constraints for table `siaf_perfil_menu`
--
ALTER TABLE `siaf_perfil_menu`
  ADD CONSTRAINT `fk_reference_60` FOREIGN KEY (`seq_perfil`) REFERENCES `siaf_perfil` (`seq_perfil`),
  ADD CONSTRAINT `fk_siaf_perfil_menu_siaf_menu` FOREIGN KEY (`seq_menu`) REFERENCES `siaf_menu` (`seq_menu`);

--
-- Constraints for table `siaf_pessoa`
--
ALTER TABLE `siaf_pessoa`
  ADD CONSTRAINT `fk_siaf_pessoa_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`),
  ADD CONSTRAINT `fk_siaf_pessoa_ect_logradouro` FOREIGN KEY (`nrcep`) REFERENCES `ect_logradouro` (`num_cep`);

--
-- Constraints for table `siaf_pessoa_cargo`
--
ALTER TABLE `siaf_pessoa_cargo`
  ADD CONSTRAINT `fk_siaf_pessoacargo_pessoa` FOREIGN KEY (`seq_pessoa`) REFERENCES `siaf_pessoa` (`seq_pessoa`),
  ADD CONSTRAINT `fk_siaf_pessoa_cargo` FOREIGN KEY (`seq_cargo`) REFERENCES `siaf_cargo` (`seq_cargo`);

--
-- Constraints for table `siaf_plano_conta`
--
ALTER TABLE `siaf_plano_conta`
  ADD CONSTRAINT `fk_siaf_planoconta_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`),
  ADD CONSTRAINT `fk_siaf_planoconta_contabancaria` FOREIGN KEY (`seq_conta_bancaria`) REFERENCES `siaf_conta_bancaria` (`seq_conta_bancaria`),
  ADD CONSTRAINT `fk_siaf_planoconta_planoconta` FOREIGN KEY (`tco_seq_plano_conta`) REFERENCES `siaf_plano_conta` (`seq_plano_conta`);

--
-- Constraints for table `siaf_trn_curso_disciplina`
--
ALTER TABLE `siaf_trn_curso_disciplina`
  ADD CONSTRAINT `fk_trn_curso_disciplina_curso` FOREIGN KEY (`seq_curso`) REFERENCES `siaf_trn_curso` (`seq_curso`),
  ADD CONSTRAINT `fk_trn_curso_disciplina_disciplina` FOREIGN KEY (`seq_disciplina`) REFERENCES `siaf_trn_disciplina` (`seq_disciplina`);

--
-- Constraints for table `siaf_trn_desconto`
--
ALTER TABLE `siaf_trn_desconto`
  ADD CONSTRAINT `fk_trn_desconto_pessoa` FOREIGN KEY (`seq_pessoa`) REFERENCES `siaf_pessoa` (`seq_pessoa`);

--
-- Constraints for table `siaf_trn_diario`
--
ALTER TABLE `siaf_trn_diario`
  ADD CONSTRAINT `fk_trn_diario_disciplina` FOREIGN KEY (`seq_disciplina`) REFERENCES `siaf_trn_disciplina` (`seq_disciplina`),
  ADD CONSTRAINT `fk_trn_diario_semestre` FOREIGN KEY (`seq_semestre`) REFERENCES `siaf_trn_semestre` (`seq_semestre`);

--
-- Constraints for table `siaf_trn_disciplina_requisito`
--
ALTER TABLE `siaf_trn_disciplina_requisito`
  ADD CONSTRAINT `fk_trn_disciplina_requisito_disciplina` FOREIGN KEY (`seq_disciplina`) REFERENCES `siaf_trn_disciplina` (`seq_disciplina`);

--
-- Constraints for table `siaf_trn_horario`
--
ALTER TABLE `siaf_trn_horario`
  ADD CONSTRAINT `fk_trn_horario_turma` FOREIGN KEY (`seq_turma`) REFERENCES `siaf_trn_turma` (`seq_turma`);

--
-- Constraints for table `siaf_trn_matricula`
--
ALTER TABLE `siaf_trn_matricula`
  ADD CONSTRAINT `fk_trn_matricula_pessoa` FOREIGN KEY (`seq_pessoa`) REFERENCES `siaf_pessoa` (`seq_pessoa`),
  ADD CONSTRAINT `fk_trn_matricula_semestre` FOREIGN KEY (`seq_semestre`) REFERENCES `siaf_trn_semestre` (`seq_semestre`),
  ADD CONSTRAINT `fk_trn_matricula_turno` FOREIGN KEY (`seq_turno`) REFERENCES `siaf_trn_turno` (`seq_turno`);

--
-- Constraints for table `siaf_trn_matricula_turma`
--
ALTER TABLE `siaf_trn_matricula_turma`
  ADD CONSTRAINT `fk_trn_matricula_turma_matricula` FOREIGN KEY (`seq_matricula`) REFERENCES `siaf_trn_matricula` (`seq_matricula`),
  ADD CONSTRAINT `fk_trn_matricula_turma_turma` FOREIGN KEY (`seq_turma`) REFERENCES `siaf_trn_turma` (`seq_turma`);

--
-- Constraints for table `siaf_trn_professor`
--
ALTER TABLE `siaf_trn_professor`
  ADD CONSTRAINT `fk_trn_professor_siaf_pessoa` FOREIGN KEY (`seq_pessoa`) REFERENCES `siaf_pessoa` (`seq_pessoa`);

--
-- Constraints for table `siaf_trn_turma__professor`
--
ALTER TABLE `siaf_trn_turma__professor`
  ADD CONSTRAINT `fk_trn_turma_professor_profefssor` FOREIGN KEY (`seq_professor`) REFERENCES `siaf_trn_professor` (`seq_professor`),
  ADD CONSTRAINT `fk_trn_turma_professor_turma` FOREIGN KEY (`seq_turma`) REFERENCES `siaf_trn_turma` (`seq_turma`);

--
-- Constraints for table `siaf_usuario`
--
ALTER TABLE `siaf_usuario`
  ADD CONSTRAINT `fk_siaf_usuario_cliente` FOREIGN KEY (`seq_cliente`) REFERENCES `fks_cliente` (`seq_cliente`),
  ADD CONSTRAINT `fk_siaf_usuario_siaf_perfil` FOREIGN KEY (`seq_perfil`) REFERENCES `siaf_perfil` (`seq_perfil`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
