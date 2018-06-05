-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 16 mai 2018 à 08:14
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Déchargement des données de la table `quiz`
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

-- --------------------------------------------------------

--
-- Structure de la table `quiz_question`
--

DROP TABLE IF EXISTS `quiz_question`;
CREATE TABLE IF NOT EXISTS `quiz_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz` int(11) NOT NULL,
  `numero_question` int(11) NOT NULL,
  `text` text NOT NULL,
  `multi` tinyint(1) DEFAULT '0',
  `temps_reponse` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `quiz_question`
--

INSERT INTO `quiz_question` (`id`, `id_quiz`, `numero_question`, `text`, `multi`, `temps_reponse`) VALUES
(1, 39, 1, 'tset', 1, 0),
(2, 40, 1, 'Coucou', 1, 60000),
(3, 41, 1, 'cc', 1, 60000),
(4, 43, 1, 'rzqr', 1, 0),
(5, 44, 1, 'f', 1, 0),
(6, 45, 1, 'aaa', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `quiz_reponse`
--

DROP TABLE IF EXISTS `quiz_reponse`;
CREATE TABLE IF NOT EXISTS `quiz_reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_quiz` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `numero_reponse` int(11) NOT NULL,
  `text` text NOT NULL,
  `juste` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `quiz_reponse`
--

INSERT INTO `quiz_reponse` (`id`, `id_quiz`, `id_question`, `numero_reponse`, `text`, `juste`) VALUES
(1, 0, 1, 1, '1', 0),
(2, 0, 1, 1, '1', 0),
(3, 0, 1, 1, '1', 0),
(4, 0, 1, 1, '1', 0),
(5, 0, 1, 1, '1', 0),
(6, 0, 1, 1, 'rzqr', 0),
(7, 0, 1, 1, 'f', 0),
(8, 0, 1, 11, 'f', 0),
(9, 0, 1, 111, 'f', 0),
(10, 0, 1, 1, 'aaa', 0),
(11, 0, 1, 2, 'aaa', 0),
(12, 0, 1, 3, 'aaa', 0);

-- --------------------------------------------------------

--
-- Structure de la table `quiz_resultat`
--

DROP TABLE IF EXISTS `quiz_resultat`;
CREATE TABLE IF NOT EXISTS `quiz_resultat` (
  `id_question` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `reponse` tinyint(1) NOT NULL,
  `temps_reponse` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
