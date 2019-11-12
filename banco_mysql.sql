-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql12-farm60.kinghost.net
-- Tempo de geração: 12/11/2019 às 13:19
-- Versão do servidor: 5.5.46-log
-- Versão do PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `migracao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ftp`
--

CREATE TABLE IF NOT EXISTS `ftp` (
  `idProcesso` int(11) NOT NULL,
  `hostFtp` text NOT NULL,
  `usuario` text NOT NULL,
  `senha` text NOT NULL,
  `arquivoProgresso` text NOT NULL,
  `dirBackup` text NOT NULL,
  `status` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `hostDestino` text NOT NULL,
  `usuarioDestino` text NOT NULL,
  `senhaDestino` text NOT NULL,
  `caminhaBackup` text NOT NULL,
  `statusUpload` int(11) NOT NULL,
  `arquivoUpload` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `ftp`
--
ALTER TABLE `ftp`
  ADD PRIMARY KEY (`idProcesso`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `ftp`
--
ALTER TABLE `ftp`
  MODIFY `idProcesso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=308;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;