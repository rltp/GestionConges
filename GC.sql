-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 19 nov. 2019 à 08:04
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `GC`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `toID` int(11) DEFAULT NULL,
  `fromID` int(11) NOT NULL,
  `comment` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `seen` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from` (`fromID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `toID`, `fromID`, `comment`, `date`, `seen`) VALUES
(34, 2, 2, 'ccc', '2019-11-14', 1),
(36, 2, 2, 'Bonsoir', '2019-11-14', 1),
(40, 2, 2, 'Jannot', '2019-11-14', 1),
(44, 2, 2, 'salut', '2019-11-14', 1),
(46, 1, 1, 'bonsoir', '2019-11-14', 1),
(49, 1, 1, 'nn', '2019-11-14', 1),
(52, 1, 1, 'lopp', '2019-11-14', 1),
(56, 1, 1, 'roi', '2019-11-14', 1),
(57, 1, 1, 'ok', '2019-11-14', 1),
(58, 1, 1, 'lo', '2019-11-14', 1),
(59, 3, 3, 'salut', '2019-11-14', 1),
(60, 1, 1, 'rkrkr', '2019-11-14', 1),
(87, 1, 2, 'Salut', '2019-11-18', 1),
(88, 2, 1, 'Salut Ã  toi', '2019-11-18', 1);

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

DROP TABLE IF EXISTS `conges`;
CREATE TABLE IF NOT EXISTS `conges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salaried` int(11) NOT NULL,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `salaried` (`salaried`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

DROP TABLE IF EXISTS `salarie`;
CREATE TABLE IF NOT EXISTS `salarie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isAdmin` tinyint(1) NOT NULL,
  `lastname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `function` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RTT` int(11) NOT NULL,
  `CP` int(11) NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `situation` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salarie`
--

INSERT INTO `salarie` (`id`, `isAdmin`, `lastname`, `firstname`, `email`, `password`, `phone`, `function`, `contract`, `date`, `RTT`, `CP`, `address`, `nationality`, `sexe`, `situation`, `birthday`) VALUES
(1, 1, 'PORTELL', 'Raphael', 'raphael.portell@gmail.com', 'f71dbe52628a3f83a77ab494817525c6', 652519078, 'Administrateur', 'CDI', '2019-11-09', 14, 15, '93220, Gagny, 3 rue jean stephan', 'Française', 'male', 'alone', '2019-11-08'),
(2, 0, 'POP', 'Pean', 'jean.doe.735@esme.fr', 'f71dbe52628a3f83a77ab494817525c6', 659874596, 'P', 'CDD', '2006-06-19', 12, 15, '', 'Française', 'female', 'alone', '1988-06-19'),
(3, 0, 'ROI', 'Jean', 'jean.doe.7@esme.fr', 'f71dbe52628a3f83a77ab494817525c6', 659874596, 'P', 'CDD', '2006-06-19', 12, 15, '92201, Gagny, 123 avenue sesame', 'Franï¿½aise', 'female', 'alone', '1988-06-19'),
(21, 0, 'Doz', 'Jean', 'jean.doe.1145@esme.fr', 'd4e1b2261456dd2e061218252e07ab6c', 659874596, '', 'CDD', '2006-06-19', 12, 15, '92201, Gagny, 123 avenue sesame noo', 'FranÃ§aise', 'female', 'alone', '1988-06-19'),
(39, 0, 'Doe', 'Jean', 'jean.doe.309@esme.fr', '5401d6bb6db40b4073a5aead1aa2c34a', 659874596, 'E', 'CDD', '19-06-2006', 10, 15, '92201, Gagny, 123 avenue sesame', 'FranÃ§aise', 'female', 'alone', '19-06-1988'),
(40, 0, 'Doe', 'Jean', 'jean.doe.1906@esme.fr', 'bb577447b0cf8dfcbae460f359141af1', 659874596, 'E', 'CDD', '19-10-2019', 10, 15, '92201, Gagny, 123 avenue sesame', 'FranÃ§aise', 'female', 'alone', '19-06-1988'),
(41, 0, 'Doe', 'Jean', 'jean.doe.1906@esme.fr', '1b42ce4ab4a4ee4540489e561010b647', 659874596, 'E', 'CDD', '19-10-2019', 10, 15, '92201, Gagny, 123 avenue sesame', 'FranÃ§aise', 'female', 'alone', '19-06-1988'),
(42, 0, 'Doe', 'Jean', 'jean.doe.1906@esme.fr', '7bc8f28d386ee4170bc949bf469446a3', 659874596, 'E', 'CDD', '19-10-2019', 10, 15, '92201, Gagny, 123 avenue sesame', 'FranÃ§aise', 'female', 'alone', '19-06-1988');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`fromID`) REFERENCES `salarie` (`id`);

--
-- Contraintes pour la table `conges`
--
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_ibfk_1` FOREIGN KEY (`salaried`) REFERENCES `salarie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
