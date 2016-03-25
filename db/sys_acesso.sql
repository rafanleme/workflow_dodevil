-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 25, 2016 as 04:25 PM
-- Versão do Servidor: 5.1.50
-- Versão do PHP: 5.3.9-ZS5.6.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `workflow_dodevil`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_acesso`
--

CREATE TABLE IF NOT EXISTS `sys_acesso` (
  `sa_sg_id` bigint(20) NOT NULL DEFAULT '0',
  `sa_sf_id` bigint(20) NOT NULL DEFAULT '0',
  `sa_sf_sf_id` bigint(20) NOT NULL DEFAULT '0',
  `sa_ss_id` bigint(20) NOT NULL DEFAULT '0',
  `sa_tipo` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'R',
  KEY `IDX_sys_acesso_1` (`sa_sg_id`,`sa_sf_id`,`sa_sf_sf_id`,`sa_ss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `sys_acesso`
--

INSERT INTO `sys_acesso` (`sa_sg_id`, `sa_sf_id`, `sa_sf_sf_id`, `sa_ss_id`, `sa_tipo`) VALUES
(1, 37, 36, 3, 'W'),
(1, 38, 36, 3, 'W'),
(14, 33, 17, 3, 'W'),
(1, 35, 34, 3, 'W'),
(1, 4, 1, 1, 'W'),
(1, 5, 1, 1, 'W'),
(14, 21, 17, 3, 'W'),
(13, 35, 34, 3, 'R'),
(1, 2, 1, 1, 'W'),
(1, 3, 1, 1, 'W'),
(15, 11, 9, 3, 'W'),
(15, 21, 17, 3, 'W'),
(14, 32, 17, 3, 'W');
