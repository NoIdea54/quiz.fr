-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 15 Mai 2018 à 12:46
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `spip2`
--

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `id_membre` int(11) NOT NULL,
  `nb_question` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `quiz`
--

INSERT INTO `quiz` (`id`, `titre`, `id_membre`, `nb_question`) VALUES
(1, 'Mon premier Quiz', 87, 5),
(2, 'Mon premier Quiz', 87, 5),
(3, 'Mon prochain Quiz', 87, 1),
(4, 'Quiz', 87, 1),
(5, 'Quiz', 87, 1),
(6, 'Quiz', 87, 1),
(7, 'Quiz', 87, 1),
(8, 'Test', 87, 1),
(9, 'test', 87, 1),
(10, 'test', 87, 1),
(11, 'test', 87, 1),
(12, 'test', 87, 7),
(13, 'test', 87, 7),
(14, 'test', 87, 7),
(15, 'test', 87, 7),
(16, 'test', 87, 1),
(17, 'test', 87, 1),
(18, 'test', 87, 7),
(19, 'test', 87, 1),
(20, 'rzqr', 87, 1),
(21, 'zd', 87, 7),
(22, 'fesf', 87, 6),
(23, 'dzq', 87, 6),
(24, 'qd', 87, 1),
(25, 'cc', 87, 10),
(26, 'd', 87, 6),
(27, '', 87, 5),
(28, '', 87, 1),
(29, '', 87, 9),
(30, '', 87, 1),
(31, '', 87, 1),
(32, '', 87, 1),
(33, '', 87, 7),
(34, 'tst', 87, 6),
(35, '', 87, 4),
(36, '', 87, 1),
(37, '', 87, 1),
(38, '', 87, 3),
(39, 'test', 87, 3),
(40, 'test', 87, 3),
(41, 'test', 87, 3),
(42, '', 87, 3),
(43, '', 87, 3),
(44, '', 87, 3),
(45, 'dz', 87, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
