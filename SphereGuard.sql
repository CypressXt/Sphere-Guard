-- phpMyAdmin SQL Dump
-- version 4.2.6
-- http://www.phpmyadmin.net
--
-- Généré le :  Mer 20 Août 2014 à 11:46
-- Version du serveur :  5.5.38-0ubuntu0.12.04.1
-- Version de PHP :  5.3.10-1ubuntu3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `SphereGuard`
--

CREATE DATABASE `SphereGuard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SphereGuard`;

-- --------------------------------------------------------

--
-- Structure de la table `api`
--

CREATE TABLE IF NOT EXISTS `api` (
`pk_api` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `apikey` text NOT NULL,
  `nbCall` float NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------


--
-- Contenu de la table `api`
--

INSERT INTO `api` (`name`, `password`, `mail`, `apikey`, `admin`) VALUES
('Admin', '8be3c943b1609fffbfc51aad666d0a04adf83c9d', 'admin@you.tld', 'df10891bfbdbb3b456bbba10d8f1ba6ca87e527c', 1);

-- --------------------------------------------------------



--
-- Structure de la table `host`
--

CREATE TABLE IF NOT EXISTS `host` (
`pk_host` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ip` varchar(16) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Structure de la table `performance`
--

CREATE TABLE IF NOT EXISTS `performance` (
`pk_performance` int(11) NOT NULL,
  `fk_type` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `fk_host` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116374 ;

-- --------------------------------------------------------

--
-- Structure de la table `performance_type`
--

CREATE TABLE IF NOT EXISTS `performance_type` (
`pk_type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `api`
--
ALTER TABLE `api`
 ADD PRIMARY KEY (`pk_api`);

--
-- Index pour la table `host`
--
ALTER TABLE `host`
 ADD PRIMARY KEY (`pk_host`);

--
-- Index pour la table `performance`
--
ALTER TABLE `performance`
 ADD PRIMARY KEY (`pk_performance`), ADD KEY `fk_type` (`fk_type`,`fk_host`), ADD KEY `fk_host` (`fk_host`);

--
-- Index pour la table `performance_type`
--
ALTER TABLE `performance_type`
 ADD PRIMARY KEY (`pk_type`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `api`
--
ALTER TABLE `api`
MODIFY `pk_api` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `host`
--
ALTER TABLE `host`
MODIFY `pk_host` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `performance`
--
ALTER TABLE `performance`
MODIFY `pk_performance` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=116374;
--
-- AUTO_INCREMENT pour la table `performance_type`
--
ALTER TABLE `performance_type`
MODIFY `pk_type` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `performance`
--
ALTER TABLE `performance`
ADD CONSTRAINT `performance_ibfk_1` FOREIGN KEY (`fk_type`) REFERENCES `performance_type` (`pk_type`),
ADD CONSTRAINT `performance_ibfk_2` FOREIGN KEY (`fk_host`) REFERENCES `host` (`pk_host`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
