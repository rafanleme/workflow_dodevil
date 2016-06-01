-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mai 31, 2016 as 09:32 PM
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
CREATE DATABASE `workflow_dodevil` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `workflow_dodevil`;

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
(1, 41, 39, 3, 'R'),
(1, 40, 39, 3, 'W'),
(14, 33, 17, 3, 'W'),
(1, 4, 1, 1, 'W'),
(1, 5, 1, 1, 'W'),
(1, 42, 1, 1, 'W'),
(14, 21, 17, 3, 'W'),
(13, 35, 34, 3, 'R'),
(1, 2, 1, 1, 'W'),
(1, 3, 1, 1, 'W'),
(15, 11, 9, 3, 'W'),
(15, 21, 17, 3, 'W'),
(14, 32, 17, 3, 'W');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_config`
--

CREATE TABLE IF NOT EXISTS `sys_config` (
  `cfg_id` int(11) NOT NULL AUTO_INCREMENT,
  `cfg_datahora_faltante` varchar(14) COLLATE latin1_general_ci DEFAULT NULL,
  `cfg_datahora_inspecao` varchar(14) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`cfg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `sys_config`
--

INSERT INTO `sys_config` (`cfg_id`, `cfg_datahora_faltante`, `cfg_datahora_inspecao`) VALUES
(1, '20110929233642', '20110929233642');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_ferramenta`
--

CREATE TABLE IF NOT EXISTS `sys_ferramenta` (
  `sf_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sf_ss_id` bigint(20) NOT NULL DEFAULT '0',
  `sf_sf_id` bigint(20) NOT NULL DEFAULT '0',
  `sf_nome` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sf_descricao` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sf_url` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sf_path` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `sf_status` tinyint(1) NOT NULL DEFAULT '0',
  `sf_ordem` int(11) NOT NULL DEFAULT '0',
  `sf_sys_sigla` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`sf_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=43 ;

--
-- Extraindo dados da tabela `sys_ferramenta`
--

INSERT INTO `sys_ferramenta` (`sf_id`, `sf_ss_id`, `sf_sf_id`, `sf_nome`, `sf_descricao`, `sf_url`, `sf_path`, `sf_status`, `sf_ordem`, `sf_sys_sigla`) VALUES
(1, 1, 0, 'Sistema Integrado', 'Administração', '-', '-', 1, -1, NULL),
(2, 1, 1, 'Módulos', '-', 'ferramentas/', 'ferramentas/', 1, 1, 'sys'),
(3, 1, 1, 'Grupos', '-', 'grupos/', 'grupos/', 1, 3, 'sys'),
(4, 1, 1, 'Usuários', '-', 'usuarios/', 'usuarios/', 1, 0, 'sys'),
(5, 1, 1, 'Sistema', 'Administração de Sistema', 'sistemas/', 'sistemas/', 1, 0, 'sys'),
(35, 3, 34, 'Pedidos', 'Visualização de pedidos integrados', 'cad_pedidos/', 'cad_pedidos/', 1, 0, 'sys'),
(12, 3, 9, 'Perfil', '-', 'cad_perfil/', 'cad_perfil/', 1, 0, 'sys'),
(42, 1, 1, 'Processos', 'Processos', '#', '#', 1, 0, 'sys'),
(10, 3, 9, 'Usuários', '-', 'cad_usuarios/', 'cad_usuarios/', 1, 0, 'sys'),
(11, 3, 9, 'Alterar Senha', '', 'cad_altera_senha/', 'cad_altera_senha/', 1, 0, 'sys'),
(13, 3, 9, 'Tarefas', '', 'cad_tarefas/', 'cad_tarefas/', 1, 0, 'sys'),
(26, 3, 23, 'Montagem Cálculos', '', 'cad_calculos/', 'cad_calculos/', 1, 0, 'sys'),
(27, 3, 17, 'Programação Operacional', '', 'rel_programacao_operacional/', 'rel_programacao_operacional/', 1, 0, 'sys'),
(39, 3, 0, 'Teste blz', 'teste', '#', 'teste', 1, 0, 'sys'),
(18, 3, 17, 'Eficiência Diária', '-', 'rel_eficiencia_diaria/', 'rel_eficiencia_diaria/', 1, 0, 'sys'),
(20, 3, 17, 'CockPit', '', 'rel_cockpit/', 'rel_cockpit/', 1, 0, 'sys'),
(21, 3, 17, 'Telão CockPit', '', 'telao_cockpit/', 'telao_cockpit/', 1, 0, 'sys'),
(24, 3, 23, 'Parâmetros Produtividade', '', 'cad_parametros/', 'cad_parametros/', 1, 0, 'sys'),
(25, 3, 23, 'Montagem Perfil', '', 'cad_perfil_tarefa/', 'cad_perfil_tarefa/', 1, 0, 'sys'),
(28, 3, 17, 'KPI Gráfico Diário', '', 'kpi_grafico_diario/', 'kpi_grafico_diario/', 1, 0, 'sys'),
(29, 3, 17, 'Produtividade', '', 'rel_produtividade/', 'rel_produtividade/', 1, 0, 'sys'),
(30, 3, 17, 'KPI Gráfico Mensal', '', 'kpi_grafico_mensal/', 'kpi_grafico_mensal/', 1, 0, 'sys'),
(31, 3, 23, 'Turnos', '', 'cad_turnos/', 'cad_turnos/', 1, 0, 'sys'),
(32, 3, 17, 'Telão Gráfico', '', 'telao_grafico/', 'telao_grafico/', 1, 0, 'sys'),
(33, 3, 17, 'Telão Eficiência', '', 'telao_eficiencia/', 'telao_eficiencia/', 1, 0, 'sys'),
(40, 3, 39, 'TesTE', 'TESTE', 'teste', 'teste', 1, 0, 'sys'),
(41, 3, 39, 'teste2', 'teste2', 'tste', 'teste', 1, 0, 'sys');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_grupo`
--

CREATE TABLE IF NOT EXISTS `sys_grupo` (
  `sg_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sg_nome` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sg_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `sys_grupo`
--

INSERT INTO `sys_grupo` (`sg_id`, `sg_nome`, `sg_status`) VALUES
(1, ' ROOT', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_sistema`
--

CREATE TABLE IF NOT EXISTS `sys_sistema` (
  `ss_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ss_nome` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ss_descricao` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ss_ordem` int(11) NOT NULL DEFAULT '0',
  `ss_contexto` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `ss_db` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`ss_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `sys_sistema`
--

INSERT INTO `sys_sistema` (`ss_id`, `ss_nome`, `ss_descricao`, `ss_ordem`, `ss_contexto`, `ss_db`) VALUES
(3, 'workflow_dodevil', 'Planejamento Controle Produção', 2, 'sys_base/', ''),
(1, 'Administração', 'Administração do Sistema.', -1, 'admin_sys/', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_usuario`
--

CREATE TABLE IF NOT EXISTS `sys_usuario` (
  `su_id` int(11) NOT NULL AUTO_INCREMENT,
  `su_login` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `su_senha` varchar(32) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `su_nome` varchar(150) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `su_email` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `su_status` tinyint(1) NOT NULL DEFAULT '0',
  `su_tipo` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `su_rf` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`su_id`),
  UNIQUE KEY `IDX_sys_usuario_2` (`su_login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=167 ;

--
-- Extraindo dados da tabela `sys_usuario`
--

INSERT INTO `sys_usuario` (`su_id`, `su_login`, `su_senha`, `su_nome`, `su_email`, `su_status`, `su_tipo`, `su_rf`) VALUES
(155, 'rleme', '908efb3718823cd68553345632877c40', 'Rafael Leme', NULL, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_usuario_rel_grupo`
--

CREATE TABLE IF NOT EXISTS `sys_usuario_rel_grupo` (
  `surg_su_id` bigint(20) NOT NULL DEFAULT '0',
  `surg_sg_id` bigint(20) NOT NULL DEFAULT '0',
  `surg_tipo` char(5) COLLATE latin1_general_ci NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `sys_usuario_rel_grupo`
--

INSERT INTO `sys_usuario_rel_grupo` (`surg_su_id`, `surg_sg_id`, `surg_tipo`) VALUES
(1, 1, 'admin'),
(3, 8, 'user'),
(3, 8, 'user'),
(5, 9, 'user'),
(6, 11, 'user'),
(4, 10, 'user'),
(6, 11, 'user'),
(4, 10, 'user'),
(5, 9, 'user'),
(4, 8, 'user'),
(9, 5, 'user'),
(9, 5, 'user'),
(63, 11, 'user'),
(124, 11, 'user'),
(124, 11, 'user'),
(118, 8, 'user'),
(9, 10, 'user'),
(120, 8, 'user'),
(102, 11, 'user'),
(121, 11, 'user'),
(67, 5, 'user'),
(110, 11, 'user'),
(100, 5, 'user'),
(121, 11, 'user'),
(84, 10, 'user'),
(102, 11, 'user'),
(103, 11, 'user'),
(96, 11, 'user'),
(51, 10, 'user'),
(9, 5, 'user'),
(3, 8, 'user'),
(93, 11, 'user'),
(76, 10, 'user'),
(133, 11, 'user'),
(94, 11, 'user'),
(86, 10, 'user'),
(109, 10, 'user'),
(108, 11, 'user'),
(109, 11, 'user'),
(120, 8, 'user'),
(98, 8, 'user'),
(116, 11, 'user'),
(98, 9, 'user'),
(114, 10, 'user'),
(119, 9, 'user'),
(101, 11, 'user'),
(100, 11, 'user'),
(123, 11, 'user'),
(113, 10, 'user'),
(112, 11, 'user'),
(111, 11, 'user'),
(110, 11, 'user'),
(98, 9, 'user'),
(74, 11, 'user'),
(72, 11, 'user'),
(73, 11, 'user'),
(70, 11, 'user'),
(123, 11, 'user'),
(127, 11, 'user'),
(99, 10, 'user'),
(75, 11, 'user'),
(3, 9, 'user'),
(5, 9, 'user'),
(76, 11, 'user'),
(82, 11, 'user'),
(86, 11, 'user'),
(89, 9, 'user'),
(92, 10, 'user'),
(87, 9, 'user'),
(84, 10, 'user'),
(85, 9, 'user'),
(91, 9, 'user'),
(88, 9, 'user'),
(83, 11, 'user'),
(77, 11, 'user'),
(90, 9, 'user'),
(121, 11, 'user'),
(119, 9, 'user'),
(71, 11, 'user'),
(106, 12, 'user'),
(78, 11, 'user'),
(123, 11, 'user'),
(139, 11, 'user'),
(97, 11, 'user'),
(51, 10, 'user'),
(56, 11, 'user'),
(55, 11, 'user'),
(98, 9, 'user'),
(61, 11, 'user'),
(54, 11, 'user'),
(118, 8, 'user'),
(117, 5, 'user'),
(53, 11, 'user'),
(52, 11, 'user'),
(57, 11, 'user'),
(106, 12, 'user'),
(80, 11, 'user'),
(79, 11, 'user'),
(127, 11, 'user'),
(65, 11, 'user'),
(115, 11, 'user'),
(2, 5, 'user'),
(67, 10, 'user'),
(126, 11, 'user'),
(68, 10, 'user'),
(105, 10, 'user'),
(69, 11, 'user'),
(60, 11, 'user'),
(59, 11, 'user'),
(65, 10, 'user'),
(103, 11, 'user'),
(125, 11, 'user'),
(128, 11, 'user'),
(70, 10, 'user'),
(65, 10, 'user'),
(56, 10, 'user'),
(105, 5, 'user'),
(52, 11, 'user'),
(110, 11, 'user'),
(125, 11, 'user'),
(129, 10, 'user'),
(130, 11, 'user'),
(131, 11, 'user'),
(113, 5, 'user'),
(54, 10, 'user'),
(108, 9, 'user'),
(108, 9, 'user'),
(141, 5, 'user'),
(113, 8, 'user'),
(9, 10, 'user'),
(57, 10, 'user'),
(132, 11, 'user'),
(132, 11, 'user'),
(133, 11, 'user'),
(134, 11, 'user'),
(55, 11, 'user'),
(135, 11, 'user'),
(136, 11, 'user'),
(136, 11, 'user'),
(137, 11, 'user'),
(53, 11, 'user'),
(136, 11, 'user'),
(130, 11, 'user'),
(138, 11, 'user'),
(138, 11, 'user'),
(138, 11, 'user'),
(53, 11, 'user'),
(109, 5, 'user'),
(109, 5, 'user'),
(110, 11, 'user'),
(109, 5, 'user'),
(109, 5, 'user'),
(139, 11, 'user'),
(109, 5, 'user'),
(118, 8, 'user'),
(113, 10, 'user'),
(103, 11, 'user'),
(53, 10, 'user'),
(53, 11, 'user'),
(0, 11, 'user'),
(141, 11, 'user'),
(0, 11, 'user'),
(113, 8, 'user'),
(113, 8, 'user'),
(113, 5, 'user'),
(142, 11, 'user'),
(143, 11, 'user'),
(144, 11, 'user'),
(145, 11, 'user'),
(146, 11, 'user'),
(147, 11, 'user'),
(148, 11, 'user'),
(149, 11, 'user'),
(150, 11, 'user'),
(151, 11, 'user'),
(80, 5, 'user'),
(68, 10, 'user'),
(80, 10, 'user'),
(113, 5, 'user'),
(109, 5, 'user'),
(139, 11, 'user'),
(152, 11, 'user'),
(153, 11, 'user'),
(154, 1, 'admin'),
(155, 14, 'user'),
(156, 14, 'user'),
(157, 13, 'user'),
(158, 13, 'user'),
(159, 13, 'user'),
(161, 13, 'user'),
(162, 13, 'user'),
(163, 13, 'user'),
(164, 13, 'user'),
(166, 15, 'user'),
(155, 15, 'user'),
(155, 13, 'user'),
(155, 1, 'admin');
