-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03-Jun-2016 às 14:19
-- Versão do servidor: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ae_eventos`
--

DROP TABLE IF EXISTS `ae_eventos`;
CREATE TABLE IF NOT EXISTS `ae_eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` datetime NOT NULL,
  `criador` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ae_eventos`
--

INSERT INTO `ae_eventos` (`id`, `titulo`, `descricao`, `data`, `criador`, `name`, `image`) VALUES
(23, 'Star Ocean: The Last Hope', 'Star Ocean é uma franquia de jogos JRPG de muito sucesso no Japão e crescente sucesso ao redor do mundo. O jogo é mistura elementos de RPG com ação, sendo que as batalhas são principalmente focadas em ação. Você pode controlar uma equipe com até 4 personagens simultaneamente o que deixa o jogo muito dinâmico e não repetitivo. O desafio do jogo é alto, várias batalhas difíceis contra vários chefes. É um jogo divertido que recomendo muito.', '2014-09-15 17:17:00', 1, 'star-ocean-the-last-hope', 'star-ocean-1.jpg'),
(24, 'Castlevania - Symfony of the Night', 'Este é um clássico dos tempos de PS1. Um jogo de ação/aventura que definiu seu próprio gênero chamado de MetroidVania. Lute contra vários inimigos para chegar até Drácula. Die Monster!', '2019-08-17 16:18:00', 1, 'castlevania-symfony-of-the-night', 'castlevania-1.jpg'),
(25, 'Bioshock Infinite', 'Bioshock é um jogo em primeira pessoa que se passa em uma realidade paralela. A época que podemos fazer referência a nossa realidade é a década de 50, porém o jogo apresenta um mundo com uma tecnologia que não era possível na época. Com a melhor personagem auxiliar da história dos games.', '2013-03-17 17:18:00', 1, 'bioshock-infinite', 'bioshock-1.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ae_usuarios`
--

DROP TABLE IF EXISTS `ae_usuarios`;
CREATE TABLE IF NOT EXISTS `ae_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NickName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ae_usuarios`
--

INSERT INTO `ae_usuarios` (`id`, `Nome`, `NickName`, `Password`) VALUES
(1, 'Bruno', 'BrunoBiluca', '123456'),
(2, 'Usuario', 'usuario', '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
