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
-- Structure de la table `quiz_reponse`
--

DROP TABLE IF EXISTS `quiz_reponse`;
CREATE TABLE IF NOT EXISTS `quiz_reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `numero_reponse` int(11) NOT NULL,
  `text` text NOT NULL,
  `juste` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `quiz_reponse`
--

INSERT INTO `quiz_reponse` (`id`, `id_question`, `numero_reponse`, `text`, `juste`) VALUES
(1, 1, 1, '1', 0),
(2, 1, 1, '1', 0),
(3, 1, 1, '1', 0),
(4, 1, 1, '1', 0),
(5, 1, 1, '1', 0),
(6, 1, 1, 'rzqr', 0),
(7, 1, 1, 'f', 0),
(8, 1, 11, 'f', 0),
(9, 1, 111, 'f', 0),
(10, 1, 1, 'aaa', 0),
(11, 1, 2, 'aaa', 0),
(12, 1, 3, 'aaa', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
