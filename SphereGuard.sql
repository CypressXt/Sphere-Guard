-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 22 Décembre 2013 à 14:18
-- Version du serveur: 5.5.32-0ubuntu0.12.04.1
-- Version de PHP: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `SphereGuard`
--
CREATE DATABASE `SphereGuard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SphereGuard`;

-- --------------------------------------------------------

--
-- Structure de la table `host`
--

CREATE TABLE IF NOT EXISTS `host` (
  `pk_host` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`pk_host`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `performance`
--

CREATE TABLE IF NOT EXISTS `performance` (
  `pk_performance` int(11) NOT NULL AUTO_INCREMENT,
  `fk_type` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `fk_host` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`pk_performance`),
  KEY `fk_type` (`fk_type`,`fk_host`),
  KEY `fk_host` (`fk_host`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=787 ;

-- --------------------------------------------------------

--
-- Structure de la table `performance_type`
--

CREATE TABLE IF NOT EXISTS `performance_type` (
  `pk_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  PRIMARY KEY (`pk_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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