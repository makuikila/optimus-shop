-- phpMyAdmin SQL Dump — Structure only (no demo data)
-- Optimus Shop — E-Commerce PHP/MySQL Application
-- Generated: 2021-07-07
-- PHP Version: 5.6.31 / MySQL 5.7.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `optimus_shop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `optimus_shop`;

-- --------------------------------------------------------
-- Table: `users`
-- Registered customers and sellers
-- --------------------------------------------------------

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
  `status` int(11) NOT NULL DEFAULT '0',   -- 0 = user, 1 = admin
  `solde` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Table: `produit`
-- Product catalog (listed by sellers)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(25) NOT NULL,
  `prix` int(11) NOT NULL,
  `categorie` varchar(10) NOT NULL,           -- 'mode' | 'itech'
  `description` text NOT NULL,
  `photo` varchar(500) NOT NULL,
  `id_users` int(11) NOT NULL,                -- FK → users.id (seller)
  `etat` varchar(15) NOT NULL DEFAULT 'en vente',  -- 'en vente' | 'vendu' | 'solde'
  PRIMARY KEY (`id_produit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Table: `livre`
-- Order / transaction ledger
-- --------------------------------------------------------

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_paye` datetime DEFAULT CURRENT_TIMESTAMP,
  `reference` text,
  `methode_paye` text,                        -- e.g. 'CC'
  `acheteur` varchar(60) DEFAULT NULL,        -- buyer email
  `vendeurs` varchar(255) DEFAULT NULL,       -- comma-separated seller IDs
  `produits` varchar(255) DEFAULT NULL,       -- comma-separated product IDs
  `quant_pro` int(5) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `transfert` varchar(10) DEFAULT NULL,       -- 'success' | 'failed'
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Table: `benefice`
-- Seller profit records per transaction
-- --------------------------------------------------------

DROP TABLE IF EXISTS `benefice`;
CREATE TABLE IF NOT EXISTS `benefice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_paye` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `benefice` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
