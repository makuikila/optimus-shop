-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 07 juil. 2021 à 02:04
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `optimus_shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `benefice`
--

DROP TABLE IF EXISTS `benefice`;
CREATE TABLE IF NOT EXISTS `benefice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_paye` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `benefice` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Data removed for public portfolio version `benefice`
--


-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_paye` datetime DEFAULT CURRENT_TIMESTAMP,
  `reference` text,
  `methode_paye` text,
  `acheteur` varchar(60) DEFAULT NULL,
  `vendeurs` varchar(255) DEFAULT NULL,
  `produits` varchar(255) DEFAULT NULL,
  `quant_pro` int(5) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `transfert` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Data removed for public portfolio version `livre`
--


-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(25) NOT NULL,
  `prix` int(11) NOT NULL,
  `categorie` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(500) NOT NULL,
  `id_users` int(11) NOT NULL,
  `etat` varchar(15) NOT NULL DEFAULT 'en vente',
  PRIMARY KEY (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Data removed for public portfolio version `produit`
--


-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_inscrip` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom_users` varchar(60) DEFAULT NULL,
  `prenom_users` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `bio` text,
  `mot_passe` varchar(20) DEFAULT NULL,
  `photo_users` varchar(100) DEFAULT NULL,
  `num_bancaire` varchar(25) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `solde` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Data removed for public portfolio version `users`
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- NOTE: This public schema intentionally excludes real/demo records.
