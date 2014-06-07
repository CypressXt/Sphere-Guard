-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 08 Juin 2014 à 00:13
-- Version du serveur: 5.5.35-0ubuntu0.12.04.2
-- Version de PHP: 5.3.10-1ubuntu3.11

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
-- Structure de la table `api`
--

CREATE TABLE IF NOT EXISTS `api` (
  `pk_api` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `key` text NOT NULL,
  `admin` int(1) NOT NULL,
  PRIMARY KEY (`pk_api`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `api`
--

INSERT INTO `api` (`pk_api`, `name`, `password`, `mail`, `key`, `admin`) VALUES
(1, 'Admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'admin@you.tld', 'df10891bfbdbb3b456bbba10d8f1ba6ca87e527c', 1);

-- --------------------------------------------------------

--
-- Structure de la table `host`
--

CREATE TABLE IF NOT EXISTS `host` (
  `pk_host` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ip` varchar(16) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81093 ;


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
-- Contenu de la table `performance_type`
--

INSERT INTO `performance_type` (`pk_type`, `name`, `unit`) VALUES
(1, 'Used RAM', '%'),
(2, 'Cpu usage', '%'),
(3, 'Disk usage', '%'),
(4, 'cpuTemp', '°C'),
(5, 'hddTemp', '°C');

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
